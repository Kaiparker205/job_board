<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Emploi;
use App\Models\Employeur;
use App\Models\Postule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
    

        $totalJobs = Emploi::count();
        $totalUsers = User::count();
        $totalApplications = Postule::count();
        $jobListings = Emploi::with('employeur.contacts')->paginate(10);

        return view('admin.dashboard', compact('totalJobs', 'totalUsers', 'totalApplications', 'jobListings'));
    }

    public function filter(Request $request)
{
    $query = Emploi::query();

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%')
            ->orWhereHas('employeur', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
    }

    $jobListings = $query->with('employeur.contacts')->paginate(10);
    return response()->json([
        'jobs' => view('admin.jobs.jobs_table', compact('jobListings'))->render(),
        'pagination' => (string) $jobListings->links()
    ]);
}


    public function static(Request $request)
    {
        $years = Emploi::withTrashed()
            ->selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get()
            ->pluck('year');
        if ($request->ajax()) {
            $year = $request->input('year');

            // Use whereYear to filter records where the year of created_at equals the specified year
            $users = Emploi::withTrashed()
                ->selectRaw('MONTH(created_at) as month')
                ->selectRaw('COUNT(*) as count')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            return response()->json($users);
        }

        return view('admin.offres.static', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function send_rapport(Request $request)
    {
        $users = User::where('role_id', '<>', 3)->get();

        foreach ($users as $user) {
            $data = new \stdClass();
            $data->name = 'admin';
            $data->username = $user->name;
            $data->content = $request->content;

            try {
                Mail::send('boite.index', ['data' => $data], function ($message) use ($user, $request) {
                    $message->to($user->email, $user->name)
                        ->subject($request->subject);
                });
            } catch (\Exception $e) {
                return to_route('admin.index')->with('fail', 'Error sending email');
            }
        }
        return to_route('admin.index')->with('success', 'Postule confirmed');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function rapports(Request $request)
    {
        // Check if the user is authenticated


        // If the user is not authenticated or doesn't have a 'boite', render the view without 'boite' data
        return view('admin.rapport.index');
    }


    public function users(Request $request)
    {
        $perPage = 10;
        // Base query for users including profile data
        $query = User::with('profil');

        if ($request->ajax()) {
            $query = User::query();
            if ($request->has('role')) {
                $query->where('role_id', $request->role);
            }
            if ($request->has('name')) {
                $query->where('name', 'like', "%" . $request->name . "%");
            }
            $users = $query->paginate($perPage);
            return view('admin.users.single_user', compact('users'));
        }

        $users = User::where('role_id', '<>', '3')->paginate($perPage);
        return view('admin.users.index', compact('users'));
    }

    function update(Request $request)
    {
        try {


            $user = User::find($request->id);
            if ($user->role_id == 1) {
                $user->role_id = 2;
            } else {
                $user->role_id = 1;
            }
            $user->save();
            return response()->json(['succes' => 'work']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'not work']);
        }
    }
    function destroy(Request $request)
    {
        try {

            $user = User::find($request->id);
            $user->delete();
            return response()->json(['succes' => 'work']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'not work']);
        }
    }
    public function rank(Request $request)
    {
        // Get the years with job postings
        $years = Emploi::withTrashed()
            ->selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($request->ajax()) {
            $year = $request->input('year');
            $employers = Emploi::withTrashed()
                ->selectRaw("COUNT(*) as nb, name")
                ->join("employeurs", "employeurs.id", "=", "emplois.employeur_id")
                ->whereYear("emplois.created_at", $year)
                ->groupBy("name")
                ->orderByDesc("nb")
                ->take(10)
                ->get();

            // Extract the relevant information (count and name) from the result
            $employerData = $employers->map(function ($employer) {
                return [
                    'name' => $employer->name,
                    'count' => $employer->nb,
                ];
            });

            return response()->json($employerData);
        }



        return view('admin.offres.rank', compact('years'));
    }
    function company(Request $request)
    {
        $years = Emploi::withTrashed()
            ->selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get()
            ->pluck('year');
        if ($request->ajax()) {
            $year = $request->input('year');

            $users = Postule::withTrashed()
                ->selectRaw("COUNT(*) as nb, title")
                ->join("emplois", "emplois.id", "=", "postules.emploi_id")
                ->whereYear("emplois.created_at", $year)
                ->groupBy("title")
                ->orderByDesc("nb")
                ->take(10)
                ->get();

            return response()->json($users);
        }

        return view('admin.offres.company', compact('years'));
    }
    public function deleteJob($id)
    {
        try {
            $job = Emploi::findOrFail($id);

            // Prepare email content
            $content = "We have deleted this job listing because it violated our policies.";

            // Prepare data for email view
            $data = new \stdClass();
            $data->name = 'Admin';
            $data->username = $job->employeur->name;
            $data->content = $content;

            // Send email to each contact of the employer
            foreach ($job->employeur->contacts as $contact) {
                Mail::send('boite.index', ['data' => $data], function ($message) use ($contact, $job) {
                    $message->to($contact->email, $job->employeur->name)
                        ->subject("Job Listing Deleted");
                });
            }

            // Delete the job listing
            $job->delete();

            return redirect()->back()->with('success', 'Job listing deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Failed to delete job listing');
        }
    }
}

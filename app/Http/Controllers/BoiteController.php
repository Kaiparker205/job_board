<?php

namespace App\Http\Controllers;

use App\Mail\Job_Board;
use App\Models\Boite;
use App\Models\Emploi;
use App\Models\Postule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BoiteController extends Controller
{
    public static function middleware()
    {
        return [
            'Employeur',
            'CheckCompany'

        ];
    }

    // Display a listing of the resource.
    public function index()
    {
        $boites = Boite::all();
        return view('boite.index', compact('boites'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('boite.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',

        ]);
        $validatedData['employeur_id'] = auth()->user()->employeur->id;
        Boite::create($validatedData);
        return to_route('postule.index')->with('success', 'Boite saved!');
    }


    public function send(Request $request)
    {
       
        // Retrieve confirmed postules related to the employer's jobs
        $confirmedPostules = Postule::whereHas('emploi', function ($query) {
            $query->where('employeur_id', auth()->user()->employeur->id);
        })->where('statu', 1);

        // Filter by specific job ID if provided
        if (!empty($request->post)) {
            $confirmedPostules->where('emploi_id', $request->post);
        }

        // Get additional data from Boite model
        $data = Boite::where('employeur_id', auth()->user()->employeur->id)->first();
        // Send emails to confirmed postules
        foreach ($confirmedPostules->get() as $postule) {
            try {
                $data->username=$postule->user->name;
                Mail::to($postule->user->email)->send(new Job_Board($data));
                $postule->delete();
            } catch (\Exception $e) {
               return to_route('postule.index')->with('fail', 'Error sending email');
            }
        }
        return to_route('postule.index')->with('success', 'Postule confirmed');
    }
    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $boite = Boite::find($id);
        return view('boite.edit', compact('boite'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Boite $boite)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
        ]);
        $boite->update($validatedData);
        return to_route('postule.index')->with('success', 'Boite updated!');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $boite = Boite::find($id);
        $boite->delete();
        return to_route('postule.index')->with('success', 'Boite deleted!');
    }
}

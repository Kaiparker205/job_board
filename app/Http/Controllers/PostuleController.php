<?php

namespace App\Http\Controllers;

use App\Mail\Job_Board;
use App\Models\Boite;
use App\Models\Competence;
use App\Models\Emploi;
use App\Models\Postule;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class PostuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware(['auth', 'verified', 'Employeur','CheckCompany'], except: ['store']),
        ];
    }
    public function index(Request $request)
{
    $id = (auth()->user()->employeur) ? auth()->user()->employeur->id : 0;
    $emplois = Emploi::where('employeur_id', $id)->get();

    if ($request->ajax()) {
        $query = Postule::query();

        if ($request->has('post')) {

                $query->where('emploi_id', $request->input('post'));

        }


        if ($request->has('competence')) {
            // Fetch users with matching competence descriptions
            $usersWithCompetences = User::whereHas('profil.competences', function ($query) use ($request) {
                $query->where('description', 'like', '%' . $request->competence . '%');
            })->pluck('id');

            $query->whereIn('user_id', $usersWithCompetences);
        }

        $postules = $query->get();
        return view('postule.postule_single', compact('postules', 'emplois'));
    }

    $postules = Postule::whereIn('emploi_id', $emplois->pluck('id'))->get();

    return view('postule.index', compact('postules', 'emplois', 'id'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'emploi_id' => 'required|exists:emplois,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'post' => 'required|string',
        ]);
        $exist = Postule::withTrashed()
            ->where('emploi_id', $validatedData['emploi_id'])
            ->where('user_id', $validatedData['user_id'])
            ->first();

        $emploi = Emploi::find($validatedData['emploi_id']);
        if ($exist) {
            return to_route('emploi.show', compact('emploi'))->with('fail', 'Emploi is postuled already !');
        }

        // Create a new Postule instance and fill it with the validated data
        $postule = Postule::create($validatedData);

        // Optionally, you can return a response or redirect to a specific route
        return to_route('emploi.show', compact('emploi'))->with('succes', 'Emploi is postuled scucces !');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $postule = Postule::findOrFail($id);
        // Update the postule status
        $postule->update([
            'statu' => 1,
        ]);
        return response()->json(['success' => 'Postule confirmed'], 200);
    }

    public function destroy($id)
    {
        $postule = Postule::findOrFail($id);
        // Perform action to reject the postule
        $postule->delete();

        return Response::json(['success' => 'Postule rejected'], 204);
    }
    public function confirme(Request $request)
    {
        if ($request->ajax()) {
            $query = Postule::query();

            if ($request->has('post')) {
                $query->where('emploi_id',  $request->post);
                $query->where('statu', 1);
            }
            $postules = $query->get();

            return view('postule.postule_confirme_single', compact('postules'));
        }

        $emplois = Emploi::where('employeur_id', auth()->user()->employeur->id)->get();
        $idsEmploi = Emploi::where('employeur_id', auth()->user()->employeur->id)->pluck('id');
        $postules = Postule::whereIn('emploi_id', $idsEmploi)->where('statu', '1')->get();

        return view('postule.confirme', compact('postules', 'emplois'));
    }
    public function boite_list(Request $request)
    {
        if ($request->ajax()) {
            $query = Postule::onlyTrashed();
            if ($request->post) {
                $query->where('emploi_id', $request->post);
            }
            $query->where('statu', 1);
            $postules = $query->get();

            return view('postule.boite_single', compact('postules'));
        }

        $emplois = Emploi::where('employeur_id', auth()->user()->employeur->id)->get();
        $idsEmploi = Emploi::where('employeur_id', auth()->user()->employeur->id)->pluck('id');
        $postules = Postule::onlyTrashed()->whereIn('emploi_id', $idsEmploi)->where('statu', '1')->get();

        return view('postule.boite', compact('postules', 'emplois'));

}
public function offres_list(Request $request)
{
    $emplois = Emploi::where('employeur_id', auth()->user()->employeur->id)->get();

    // Détermine si la requête demande les offres supprimées ou non.
    $trashed = $request->input('trashed', 'no');

    if ($request->ajax()) {
        $query = Emploi::query(); // Utilisez query() pour une nouvelle instance de la requête.

        if ($trashed === 'yes') {
            $query->onlyTrashed(); // Récupère uniquement les offres supprimées.
        }
        $query->where('employeur_id', auth()->user()->employeur->id);
        $emplois = $query->get();

        return view('postule.offre_single', compact('emplois'));
    }


    return view('postule.offre', compact( 'emplois'));
}

}

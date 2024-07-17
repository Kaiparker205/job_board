<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Emploi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\Middleware;

class EmploiController extends Controller
{
    use AuthorizesRequests;
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware(['auth', 'verified'], except: ['index', 'show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_term = $request->search;
        $this->delay_check();
        if ($request->ajax()) {
            if($request->page){
                $emplois = Emploi::with('employeur')
                    ->where('description', 'like', "%$request->search%")
                    ->orderBy('id', 'desc')
                    ->paginate(10);
                return view('emploi.single_emploi', compact('emplois', 'search_term'));}

        }
        $emplois = Emploi::with('employeur')->orderBy('id', 'desc')->paginate(10);
        return view('emploi.index', compact('emplois', 'search_term'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Emploi::class);
        return view('emploi.create');
    }

    /**
     * Store a newly created emploi in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Emploi::class);

        if (!auth()->user()->employeur) {
            return to_route('emploi.create')->with('fail', 'Emploi has failed. Check your company info.');
        }

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'salary' => 'required|numeric',
            'delay' => 'required|min:1',

        ]);
        $validatedData['employeur_id'] = auth()->user()->employeur->id;
        Emploi::create($validatedData);
        return to_route('emploi.index')->with('success', 'Emploi created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Emploi $emploi)
    {
        $contact = Contact::where('employeur_id', $emploi->employeur_id)->first();
        return view('emploi.show', compact('emploi', 'contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emploi $emploi)
    {
        $this->authorize('edit', $emploi);
        return view('emploi.edit', compact('emploi'));
    }

    /**
     * Update the specified emploi in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emploi $emploi)
    {
        $this->authorize('update', $emploi);

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'salary' => 'required|numeric',
            'employeur_id' => 'required|exists:employeurs,id',
            'delay' => 'required|min:1',
        ]);

        $emploi->update($validatedData);

        return to_route('emploi.index')->with('success', 'Emploi updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emploi $emploi)
    {
        $this->authorize('delete', $emploi);
        $emploi->delete();

        return to_route('emploi.index')->with('success', 'Emploi deleted successfully!');
    }
    public function delay_check()
    {
        $emplois = Emploi::all();
        foreach ($emplois as $emploi) {
            $date_end = $emploi->updated_at->addDays($emploi->delay);
            if ($date_end < now()) {
                $emploi->delete();
            }
        }
        return $emplois;
    }
}

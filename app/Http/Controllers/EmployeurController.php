<?php

namespace App\Http\Controllers;

use App\Models\Employeur;
use Illuminate\Http\Request;

class EmployeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeur =Employeur::where('user_id',auth()->user()->id)->first();
        return view('employeur.index',compact('employeur'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employeur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required','unique:employeurs'],
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        Employeur::create($validatedData);
        return to_route('employeur.index')->with('employeur', 'Emploi created successfully!');
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employeur $employeur)
    {
        return view('employeur.edit', compact('employeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employeur $employeur)
    {
        $validatedData = $request->validate([
            'name' => ['required','unique:employeurs'],
        ]);
        Employeur::where('id',$employeur->id)->update($validatedData);
        return to_route('employeur.index')->with('employeur', 'Emploi created successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employeur $employeur)
    {
        $employeur->delete();
        return to_route('employeur.index')->with('employeur', 'Emploi created successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Competence; // Changed from Diplome to Competence
use Illuminate\Http\Request;

class CompetenceController extends Controller // Renamed the class
{
    /**
     * Display a listing of the resource.
     */
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("competence.create"); // Changed from diplome.create to competence.create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', // Changed from type to name
            'description' => 'required', // Changed from place to description
        ]);

        Competence::create([ // Changed from Diplome::create to Competence::create
            'name' => $request->name, // Changed from type to name
            'description' => $request->description, // Changed from place to description
            'profil_id' => auth()->user()->profil->id,
        ]);

        return to_route('profile.index')->with('success', 'Competence added successfully!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $competence = Competence::find($id); // Changed from Diplome::find to Competence::find
        return view('competence.edit', compact('competence')); // Changed from diplome.edit to competence.edit
    }

    public function update(Request $request, Competence $competence) // Changed from Diplome $diplome to Competence $competence
    {
        $request->validate([
            'name' => 'required', // Changed from type to name
            'description' => 'required', // Changed from place to description
        ]);

        $competence->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return to_route('profile.index')->with('success', 'Competence updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence) // Changed from Diplome $diplome to Competence $competence
    {
        $competence->delete(); // Changed from $diplome->delete to $competence->delete

        session()->flash('success', 'Competence deleted successfully!');
        return to_route('profile.index')->with('success', 'Competence deleted successfully!');
    }
}

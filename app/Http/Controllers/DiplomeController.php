<?php

namespace App\Http\Controllers;

use App\Models\diplome;
use Illuminate\Http\Request;

class DiplomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("diplome.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'place' => 'required',
        ]);

        Diplome::create([
            'type' => $request->type,
            'place' => $request->place,
            'profil_id' => auth()->user()->profil->id,
        ]);

        return to_route('profile.index')->with('success', 'Diploma added successfully!');
    }
    /**
     * Display the specified resource.
     */



    public function edit($id){
        $diplome = Diplome::find($id);
        return view('diplome.edit', compact('diplome'));
    }

    public function update(Request $request, Diplome $diplome)
    {
        $request->validate([
            'type' => 'required',
            'place' => 'required',
        ]);

        $diplome->update([
            'type' => $request->type,
            'place' => $request->place,
        ]);

        return to_route('profile.index')->with('success', 'Diploma updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diplome $diplome)
    {
        $diplome->delete();

        session()->flash('success', 'Diploma deleted successfully!');
        return redirect()->route('profile.index');
    }
}

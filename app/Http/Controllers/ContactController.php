<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
        ]);
        $validatedData['employeur_id'] = auth()->user()->employeur->id;
        Contact::create($validatedData);

        return to_route('employeur.index')->with('success', 'Contact created successfully.');
    }

    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $contact->update($validatedData);

        return to_route('employeur.index')->with('success', 'Contact updated successfully.');
    }
    public function destroy(Contact $contact){
        $contact->delete();
        return to_route('employeur.index')->with('success', 'Contact deleted successfully.');

    }
}

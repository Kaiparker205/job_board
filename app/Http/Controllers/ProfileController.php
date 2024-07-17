<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profil;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(){
        $profil =Profil::where('user_id',auth()->user()->id)->first();
        return view('dashboard',compact('profil'));
    }
    public function show($id){
        $profil = Profil::where('user_id', $id)->firstOrFail();
        return view('profile.show',compact('profil'));
    }
    public function create(){
        return view('profile.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cv_path' => 'required|file|mimes:pdf',
            'profil_path' => 'required|image',
        ]);

        // Store the CV file with a custom name
        $enregistre_name=auth()->user()->name.''.auth()->user()->id;
        $request->file('cv_path')->storeAs('public/cvs', $enregistre_name.'.pdf');
        $cvPath = 'storage/cvs/'.$enregistre_name.'.pdf';
        $validatedData['cv_path']=$cvPath;

        // Store the profile image with a custom name
        $request->file('profil_path')->storeAs('public/profile_images',  $enregistre_name.'.jpg');
        $validatedData['profil_path'] = 'storage/profile_images/'.$enregistre_name.'.jpg';

        // Associate the user ID with the validated data
        $validatedData['user_id'] = auth()->user()->id;

        // Create a new Profil record
        Profil::create($validatedData);



        // Redirect to the profile index route
        return to_route('profile.index')->with('success', 'CV added successfully!');
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function edit_profil(): View
    {
        return view('profile.edit_profil', [
            'profil' => auth()->user()->profil,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return to_route('profile.index')->with('succes', 'Profil is updated scucces !');
    }
    // app/Http/Controllers/ProfileController.php

    public function update_profil(Request $request)
    {
        $profil = Profil::where('user_id', auth()->user()->id)->first();
        $validatedData = $request->validate([
            'cv_path' => 'nullable|file|mimes:pdf',
            'profil_path' => 'nullable|image',
            // Other validation rules
        ]);

        // Generate a unique name for the file based on the profile ID and current timestamp
        $fileName = 'profil_' . $profil->id . '_' . time();

        if ($request->hasFile('cv_path')) {
            // Delete the old CV file if it exists
            Storage::delete($profil->cv_path);

            // Store the CV with a custom name
            $cvPath = $request->file('cv_path')->storeAs('storage/cvs', $fileName . '.pdf');
            $profil->cv_path = $cvPath;
        }

        if ($request->hasFile('profil_path')) {
            // Delete the old profile image if it exists
            Storage::delete($profil->profil_path);

            // Store the profile image with a custom name
            $profileImagePath = $request->file('profil_path')->storeAs('storage/profile_images', $fileName . '.jpg');
            $profil->profil_path = $profileImagePath;
        }



        $profil->save();

        return redirect()->route('profile.index');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

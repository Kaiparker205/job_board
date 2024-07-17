<?php

namespace App\Http\Controllers;

use App\Models\Emploi;
use App\Models\Employeur;
use App\Models\Postule;
use App\Models\User;
use Illuminate\Http\Request;

class HomePage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalJobs = Emploi::withTrashed()->count();
        $totalCondidates = User::withTrashed()->where("role_id", "1")->count();
        $totalApplications = Postule::withTrashed()->count();
        $companyies = Employeur::withTrashed()->count();
        return view('home.index',compact('totalJobs','totalCondidates','totalApplications','companyies'
        ));

    }
}

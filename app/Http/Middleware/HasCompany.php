<?php

namespace App\Http\Middleware;

use App\Models\Employeur;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HasCompany
{
    public function handle(Request $request, Closure $next): Response
    {


        // Handle the case where the user has no associated employeur
        if (Auth::user()->employeur) {
            return $next($request);
        }
        // Continue processing the request if the user has an employeur
        return redirect('/')->with('fail', 'Create a company first to access this area.');
    }
}

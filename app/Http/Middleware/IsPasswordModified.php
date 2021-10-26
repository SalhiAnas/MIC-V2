<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsPasswordModified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ((auth::user()->password_modified_at == null) && (auth::user()->type_profile=="user") )
        {
            return redirect(route('profile-edit'))->withErrors(['error' => 'Vous devez changer votre mot de passe dans votre premiere authentification !']);;
        }
        else
        {
            return $next($request);
        }

    }
}

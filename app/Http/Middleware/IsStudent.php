<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role === RoleEnum::Student->value || Auth::user()->role === "super_admin") {
            return $next($request);
        }
        return redirect(route('index'))/*->with('error', "Vous n'avez pas accès à cette partie de l'application. Cette partie est réservée aux délégué.e.s et aux étudiant.e.s.")*/;
    }
}

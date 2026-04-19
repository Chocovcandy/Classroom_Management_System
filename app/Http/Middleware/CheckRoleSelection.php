<?php
namespace App\Http\Middleware;   

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

Class CheckRoleSelection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // If the user has multiple roles and has NOT selected one yet
        if ($user && $user->roles->count() > 1 && !$request->session()->has('current_role')) {
            return redirect()->route('role.select'); // redirect to role selection page
        }

        return $next($request);
    }
}

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
public function handle($request, Closure $next)
{
    $user = Auth::user();

    if (!$user) {
        return redirect('/login');
    }

    $roles = $user->roles;

    if ($roles->count() > 1) {

        $currentRole = $request->session()->get('current_role');

        // If no role selected OR invalid role selected
        if (
            !$currentRole ||
            !$roles->pluck('role_name')->contains($currentRole)
        ) {
            return redirect()->route('role.select');
        }
    }

    return $next($request);
}
}

<?php
namespace App\Http\Middleware;   

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

Class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
public function handle(Request $request, Closure $next, ...$roles)
{

    // Check if the user is authenticated
    if (!Auth::check()) {
        return redirect('/login');
    }

    // Get the authenticated user

    $user = Auth::user();
   
   
    // covert roles to lowercase to make it macth case-insensitive (e.g. 'Dean' and 'dean' will both work)
    //and why we need it? because in the database, the role names might be stored in different cases (e.g. 'Dean', 'dean', 'DEAN'),
    // and we want to ensure DB format roles MATCH the Route format for roles (e.g. 'Dean' in DB should match 'dean' in Route) and to match we need to lowercase both sides.
    //by this way, we can avoid issues where the role names mismatch due to case sensitivity, and leads us to 403 error 
    //when the user actually has the correct role but just in different case format.



    //this line converts the allowed roles passed to the middleware into lowercase format, so that we can compare them with the user's roles in a case-insensitive way. So that they match with the role names stored in the database, 
    //regardless of how they are cased (e.g. 'Dean', 'dean', 'DEAN' will all match if we lowercase them).
    $allowedRoles = array_map('strtolower', $roles);
    //

    //this check verifies if the authenticated user has any of the allowed roles by checking if any of the user's roles (converted to lowercase) match any of the allowed roles (also in lowercase). If there is no match, it aborts with a 403 error, 
    //If there is a match, it allows the request to proceed to the next middleware or controller.
    $hasRole = $user->roles->contains(function ($role) use ($allowedRoles) {
        return in_array(strtolower($role->role_name), $allowedRoles); // this line converts the role name of each of the user's roles to lowercase and checks if it exists in the array of allowed roles (also in lowercase). This ensures that they match in a with the route format, so that 'Dean', 'dean', 'DEAN' will all be considered a match if 'dean' is in the allowed roles.
    });

    if (!$hasRole) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}
}

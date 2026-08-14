<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function Pest\Laravel\session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();
    $roles = $user->roles;

    if ($roles->isEmpty()) {
        abort(403, 'No role assigned to this user');
    }

    // Multiple roles -> choose role
    if ($roles->count() > 1) {
        return redirect()->route('role.select');
    }

$role = $roles->first();

$request->session()->put('active_role_id', $role->id);

return match ($role->role_name) {
    'Admin' => redirect()->route('admin.dashboard'),
    'Dean' => redirect()->route('dean.dashboard'),
    'HoD' => redirect()->route('hod.dashboard'),
    'Professor' => redirect()->route('professor.dashboard'),
    'Student' => redirect()->route('student.dashboard'),
    default => abort(403),
};
}
    /**
     * Destroy an authenticated session.
     */
public function destroy(Request $request): RedirectResponse
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}

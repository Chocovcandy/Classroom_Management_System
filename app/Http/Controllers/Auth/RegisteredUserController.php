<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'ends_with:@lifeun.edu.kh',
                'unique:users',
            ],

            'password' => [
                'required',
                'confirmed',
                \Illuminate\Validation\Rules\Password::defaults(),
            ],
        ], [
            'email.ends_with' => 'You must use your university email ending with @life.edu.kh.',
        ]);

        // 1. Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Assign Student role
        $user->assignStudentRole();

        // 3. Login user
        Auth::login($user);

        // 4. Set current session role
        session([
            'current_role' => 'student',
        ]);

        // 5. Redirect to student dashboard
        return redirect()->route('student.dashboard');
    }
}
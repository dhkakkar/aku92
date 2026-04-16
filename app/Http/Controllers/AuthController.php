<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->isAdmin() ? '/admin' : '/my-account');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (! Auth::attempt($data, (bool) $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        return redirect()->intended(Auth::user()->isAdmin() ? '/admin' : '/my-account');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/my-account');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|max:150|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        // Use raw insert to avoid Neon postgres savepoint issue inside Eloquent events.
        $now = now();
        $userId = DB::table('users')->insertGetId([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'password'   => Hash::make($data['password']),
            'role'       => 'customer',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Auth::loginUsingId($userId);
        $request->session()->regenerate();

        return redirect('/my-account');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectUser(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->has('remember'));
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'role' => $user->role,
                'redirect' => $this->getRedirectPath($user),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username atau password salah.',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function redirectUser($user)
    {
        return redirect($this->getRedirectPath($user));
    }

    protected function getRedirectPath($user)
    {
        switch ($user->role) {
            case 'pengguna':
                return route('dashboard');
            case 'kasubbag':
                return route('kasubbag');
            case 'solver':
                return route('solver');
            case 'operator':
                return route('operator');
            default:
                return '/';
        }
    }
}

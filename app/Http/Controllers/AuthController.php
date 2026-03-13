<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function register(Request $request) { 
        User::create([
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'user'
        ]);
        return redirect('/login');
    }

    public function login(Request $request) {
        $user = User::where('username', $request->username)
                    ->where('password', $request->password)
                    ->first();

        if ($user) {
            Auth::login($user);
            return redirect('/produk');
        }
        return back()->with('error', 'Username atau Password salah');
    }

    public function logout(Request $request) {  
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
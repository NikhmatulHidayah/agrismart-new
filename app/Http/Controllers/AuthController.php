<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getRegisterExpert()
    {
        return view('expert.register');
    }

    public function getLoginExpert()
    {
        return view('expert.login');
    }

    public function getRegisterFarmer()
    {
        return view('farmer.register');
    }

    public function getLoginFarmer()
    {
        return view('farmer.login');
    }

    public function postRegisterExpert(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images', $imageName);
        }

        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'picture' => $imagePath,
            'role' => 'expert',
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function postRegisterFarmer(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images', $imageName);
        }

        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'picture' => $imagePath,
            'role' => 'farmer',
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'expert') {
                return redirect('/expert');
            } elseif ($user->role === 'farmer') {
                return redirect()->route('dashboard.farmer');
            } else {
                Auth::logout();
                return redirect('/login')->withErrors(['login_error' => 'Role tidak dikenali']);
            }
        }

        return back()->withErrors(['login_error' => 'Email atau Password salah!'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DataAhliTani;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Menampilkan form login admin
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Logika autentikasi admin
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard'); // Redirect ke dashboard admin
        }

        return back()->withErrors(['login_error' => 'Invalid email or password']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/admin/login'); // Redirect ke halaman login setelah logout
    }

    // public function showManageExpert()
    // {
    //     return view('admin.manage-expert');  // Pastikan file ini ada di resources/views/admin/manage-expert.blade.php
    // }

    // Menghitung total farmer dan expert


    public function index()
    {
        $totalFarmer = User::where('role', 'farmer')->count();
        $totalExpert = DataAhliTani::count();

        $recentExperts = DataAhliTani::with(['user'])
            ->whereHas('user', function ($query) {
                $query->where('role', 'expert');
            })
            ->latest()
            ->take(5)
            ->get();


        return view('admin.dashboard', compact('totalFarmer', 'totalExpert', 'recentExperts'));
    }
}

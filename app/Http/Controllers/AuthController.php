<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getRegisterExpert(){
        return view('expert.register');
    }

    public function getLoginExpert(){
        return view('expert.login');
    }

    public function getRegisterFarmer(){
        return view('farmer.register');
    }

    public function getLoginFarmer(){
        return view('farmer.login');
    }

    public function postRegisterExpert(Request $request) {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images', $imageName);
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'picture' => $imagePath,
            'role' => 'expert',
        ];

        DB::table('users')->insert($data);
        
        return redirect('/select-role')->with('success', 'Akun berhasil dibuat. Silahkan login.');
    }

    public function postRegisterFarmer(Request $request) {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images', $imageName);
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'picture' => $imagePath,
            'role' => 'farmer',
        ];

        DB::table('users')->insert($data);

        return redirect('/select-role')->with('success', 'Akun berhasil dibuat. Silahkan login.');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Set session
            Session::put('user_id', $user->id);
        
            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'expert') {
                return redirect('/expert');
            } elseif ($user->role === 'farmer') {
                return redirect('farmer/views/dashboard');
            } else {
                return redirect('/')->withErrors(['login_error' => 'Role tidak dikenali']);
            }
        } else {
            return back()->withErrors(['login_error' => 'Email atau Password salah!'])->withInput();
        }
    }
}

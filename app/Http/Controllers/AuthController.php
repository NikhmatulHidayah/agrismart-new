<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getRegisterExpert(){
        return view('expert.register');
    }
    public function getLoginExpert(){
        return view('expert.login');
    }
}

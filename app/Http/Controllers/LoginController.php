<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function mostrarLogin()
    {
        return view('login_teste');
    }
}
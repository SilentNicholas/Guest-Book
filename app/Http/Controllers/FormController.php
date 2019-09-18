<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function create(Request $request)
    {
        $request->validate([
           'username' => 'required',
            'email' => 'required|email',
            'theme' => 'required',
            'comment' => 'required'
        ]);
        if (!User::where('email', '=', $request->input('email'))->exists()) {
            User::add(['username' => $request->input('username'), 'email' => $request->input('email')]);
        }
    }
}

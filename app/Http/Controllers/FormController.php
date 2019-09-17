<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
           'username' => 'require',
            'email' => 'require',
            'theme' => 'require',
            'comment' => 'require'
        ]);
    }
}

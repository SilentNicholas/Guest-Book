<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.pages.users', ['users' => User::all()]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $user->toggleStatus($user);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->comments->each->delete();
        $user->delete();
        return redirect()->back();
    }
}

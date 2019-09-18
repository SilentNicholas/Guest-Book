<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        dd(User::find($id));
        return User::find($id);
    }

    public function emailConfirm($token)
    {
        $user = User::where('remember_token', '=', $token)->firstOrFail();
        $user->confirm($user);
        return redirect('/')->with('message', 'Ваш email был успешно подтвержден! Теперь вы можете оставлять комментарии.');
    }
}

<?php

namespace App\Http\Controllers;

use App\User;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('pages.profile', ['user' => User::find($id)]);
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function emailConfirm(string $token)
    {
        $user = User::where('remember_token', '=', $token)->firstOrFail();
        $user->confirm($user);
        return redirect('/')->with('message', 'Ваш email был успешно подтвержден! Теперь вы можете оставлять комментарии.');
    }
}

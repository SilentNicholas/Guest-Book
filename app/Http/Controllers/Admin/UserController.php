<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.users', ['users' => User::all()]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        $user = User::find($id);
        $user->toggleStatus($user);
        return redirect()->back();
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->comments->each->delete();
        $user->delete();
        return redirect()->back();
    }
}

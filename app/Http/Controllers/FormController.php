<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmMail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
           'username' => 'required',
            'email' => 'required|email',
            'theme' => 'required',
            'comment' => 'required'
        ]);
        if (!User::where('email', '=', $request->input('email'))->exists()) {
        if (User::where('name', '=', $request->input('username'))->exists()) {
            return redirect()->back()->with('message', 'Данное имя уже занято!');
        }
            $user = User::add(['name' => $request->input('username'), 'email' => $request->input('email')]);
            $this->sendEmail($user);
            return redirect()->back()->with('message', 'Для того, чтобы оставить комментарий, подтвердите вашу почту. Вам было выслано письмо с дальнейшими инструкциями.');
        }
        return redirect()->back()->with('message', 'Данное имя уже используется!');
    }

    public function sendEmail($user)
    {
        Mail::to($user->email)->send(new ConfirmMail($user));
    }
}

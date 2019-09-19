<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Mail\ConfirmMail;
use App\Notifications\AddedComment;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
        $user = User::where('email', '=', $request->input('email'))->firstOrFail();
        Comment::add(['title' => $request->input('theme'), 'text' => $request->input('comment'), 'user' => $user]);
        $this->sendNotification($user);
        return redirect()->back()->with('message', 'Спасибо вам, за отзыв!');
    }

    public function sendNotification($user)
    {
//        $users = User::where('id', '!=', $user->id)->get();
        $users = User::where('id', '>', 50)->get();
        Notification::send($users, new AddedComment($user));
    }

    public function sendEmail($user)
    {
        Mail::to($user->email)->send(new ConfirmMail($user));
    }
}

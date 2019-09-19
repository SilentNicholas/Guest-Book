<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Mail\ConfirmMail;
use App\Notifications\AddedComment;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

/**
 * Class FormController
 * @package App\Http\Controllers
 */
class FormController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $this->validateFormInputs($request);
        $user = new User;
        $email = $request->input('email');
        if (!$user->isUserRegister($email)) {
            if ($user->isUsernameInUse($request->input('username'))) {
                return redirect()->back()->withInput($request->input())->with('message', 'Данное имя уже занято!');
            }
            $user = User::add(['name' => $request->input('username'), 'email' => $request->input('email')]);
            $this->verifyEmail($user);
            return redirect()->back()->withInput($request->input())
                ->with('message', 'Для того, чтобы оставить комментарий, подтвердите вашу почту. Вам было выслано письмо с дальнейшими инструкциями.');
        }
        $user = $user->getUserByEmail($email);
        $this->createComment($request, $user);
        $this->sendNotification($user);
        return redirect()->back()->with('message', 'Спасибо вам, за отзыв!');
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function createComment(Request $request, User $user)
    {
        Comment::add(['title' => $request->input('theme'), 'text' => $request->input('comment'), 'user' => $user]);
    }

    /**
     * @param Request $request
     */
    public function validateFormInputs(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'theme' => 'required',
            'comment' => 'required'
        ]);
    }

    /**
     * @param User $user
     */
    public function sendNotification(User $user)
    {
        $users = User::where('id', '!=', $user->id)->get();
        Notification::send($users, new AddedComment($user));
    }

    /**
     * @param User $user
     */
    public function verifyEmail(User $user)
    {
        Mail::to($user->email)->send(new ConfirmMail($user));
    }
}

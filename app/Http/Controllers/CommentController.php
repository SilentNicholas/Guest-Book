<?php

namespace App\Http\Controllers;

use App\Comment;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.index', ['comments' => Comment::orderBy('updated_at', 'desc')->paginate(15)]);
    }
}

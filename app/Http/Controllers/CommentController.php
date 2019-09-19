<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('pages.index', ['comments' => Comment::orderBy('updated_at', 'desc')->paginate(15)]);
    }
}

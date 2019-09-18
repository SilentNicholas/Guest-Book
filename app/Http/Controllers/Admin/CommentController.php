<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        return view('admin.pages.comments', ['comments' => Comment::all()]);
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        $comment->toggleStatus($comment);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back();
    }
}

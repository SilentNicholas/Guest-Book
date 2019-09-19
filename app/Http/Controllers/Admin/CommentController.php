<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;

/**
 * Class CommentController
 * @package App\Http\Controllers\Admin
 */
class CommentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.comments', ['comments' => Comment::all()]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        $comment = Comment::find($id);
        $comment->toggleStatus($comment);
        return redirect()->back();
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back();
    }
}

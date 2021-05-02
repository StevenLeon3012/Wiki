<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:comment-list|blog-create|blog-edit|blog-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:comment-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:comment-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:comment-delete', ['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        request()->validate([
            'user_id' => 'required',
            'blog_id' => 'required',
            'body' => 'required',
        ]);
        $comment = Comment::create($request->all());
        return redirect()->route('blogs.show',  $comment->blog_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment) {
        $blog_id = $comment->blog_id;
        $comment->delete();
        return redirect()->route('blogs.show', $blog_id)
                        ->with('success', 'Blog eliminado correctamente');
    }

}

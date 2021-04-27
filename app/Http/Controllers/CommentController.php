<?php
namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\User;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $blogs = Blog::orderBy('id','DESC')->get();
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('comments.create', compact('comments', 'blogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        request()->validate([
            'body' => 'required'

        ]);
        $comment = Comment::create($request->all());
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment) {
        $user = User::find($comment->user_id);
        $blog = Blog::find($comment->blog_id);
        return view('comment.show', compact('comment', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment) {
        return view('comments.edit', compact('comment'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment) {
        request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $comment->update($request->all());
        return redirect()->route('comments.index')
                        ->with('success', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment) {
        $comment->delete();
        return redirect()->route('comments.index')
                        ->with('success', 'Comment deleted successfully');
    }
}
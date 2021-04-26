<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;

class BlogController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:blog-list|blog-create|blog-edit|blog-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:blog-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $blogs = Blog::orderBy('id','DESC')->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::all();
        $tags = Tag::all();
        return view('blogs.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'status_id' => 'required',
            'tags' => 'required'
        ]);
        
        $blog = Blog::create($request->all());
        if($request->file('picture')){
            $url = $request->file('picture')->store('public');
            $blog->image()->create([
              'url' => $url  
            ]);
        }
        $blog->tags()->attach($request->tags);        
        return redirect()->route('blogs.index')
                        ->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog) {
        $user = User::find($blog->user_id);
        $comments = \DB::select("Select * from comments where blog_id = {$blog->id}");
        // $comments = \DB::table('comments')->where('blog_id', $blog->id)
        //     ->pluck('id', 'created_at', 'updated_at', 'user_id', 'blog_id', 'body')
        //     ->get();
        return view('blogs.show', compact('blog', 'user', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog) {
        $categories = Category::all();
//        $tags = Tag::pluck('tag', 'tag');
//        $blog_tag = $blog->tags->pluck('tag','tag')->all();

        $tags = Tag::get();
        $blog_tag = \DB::table("blog_tag")->where("blog_tag.blog_id",$blog->id)
            ->pluck('blog_tag.tag_id','blog_tag.tag_id')
            ->all();
        return view('blogs.edit', compact('blog', 'categories', 'tags', 'blog_tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog) {
        request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        $blog->update($request->all());

        return redirect()->route('blogs.index')
                        ->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog) {
        $blog->delete();

        return redirect()->route('blogs.index')
                        ->with('success', 'Blog deleted successfully');
    }

}

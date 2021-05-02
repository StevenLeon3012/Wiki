<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blog_Type;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Status;
use Illuminate\Support\Facades\Storage;

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
        $blogs = Blog::orderBy('created_at', 'DESC')->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::all();
        $blog_types = Blog_Type::all();
        $tags = Tag::all();
        return view('blogs.create', compact('categories', 'tags', 'blog_types'));
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
            'blog_type_id' => 'required',
            'category_id' => 'required',
            'status_id' => 'required',
            'tags' => 'required',
            'picture' => 'image'
            
        ]);
        $blog = Blog::create($request->all());
        
        if ($request->file('picture')) {
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
        $blogs_by_category = Blog::latest()->where('category_id', $blog->category_id)->paginate(4);
        $category = Category::orderBy('created_at', 'DESC')->where('id', $blog->category_id)->get();
        $status = Status::orderBy('created_at', 'DESC')->where('id', $blog->status_id)->get();
        return view('blogs.show', compact('blog', 'user', 'comments', 'blogs_by_category', 'category', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog) {
        $categories = Category::all();
        $blog_types = Blog_Type::all();
        $status = Status::all();
        $tags = Tag::get();
        $blog_tag = \DB::table("blog_tag")->where("blog_tag.blog_id", $blog->id)
                ->pluck('blog_tag.tag_id', 'blog_tag.tag_id')
                ->all();
        return view('blogs.edit', compact('blog', 'categories', 'tags', 'blog_tag', 'blog_types', 'status'));
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
            'status_id' => 'required',
            'tags' => 'required',
            'picture' => 'image'
        ]);
        $blog->update($request->all());
        \DB::table('blog_tag')->where('blog_id', $blog->id)->delete();
        $blog->tags()->attach($request->tags);
        if ($request->file('picture')) {
            if($blog->image){
                Storage::delete($blog->image->url);
                $url = $request->file('picture')->store('public');
                $blog->image()->update([
                    'url' => $url
                ]);
            }else{
                $url = $request->file('picture')->store('public');
                $blog->image()->create([
                    'url' => $url
                ]);
            }
        }
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

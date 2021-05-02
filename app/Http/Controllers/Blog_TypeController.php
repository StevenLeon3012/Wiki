<?php

namespace App\Http\Controllers;
use App\Models\Blog_Type;
use App\Models\Blog;

class Blog_TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $blogs = Blog::orderBy('created_at', 'DESC')->get();
        $blog_type = Blog_Type::all();        
        return view('blog_type.index', compact('blogs', 'blog_type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog_Type  $blog_type
     * @return \Illuminate\Http\Response
     */
    public function show(Blog_Type $blog_type) {
        $blogs = Blog::orderBy('created_at', 'DESC')->where('blog_type_id', $blog_type->id)->get();
        $blog_type_type = Blog_Type::where('id', $blog_type->id)->get();
        return view('blog_type.show', compact('blogs', 'blog_type_type', 'blog_type'));
    }

}

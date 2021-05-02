<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;


class TagController extends Controller {
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $blogs = Blog::orderBy('created_at', 'DESC')->get();
        $tags = Tag::all();        
        return view('tags.index', compact('blogs', 'tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag) {
        $blogs = $tag->blogs;
        $tags = Tag::all();
        return view('tags.show', compact('blogs', 'tags' , 'tag'));
    }   

}

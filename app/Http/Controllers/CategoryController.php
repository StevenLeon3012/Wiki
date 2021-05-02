<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $blogs = Blog::orderBy('created_at', 'DESC')->get();
        $categories = Category::all();        
        return view('categories.index', compact('blogs', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) {
        $blogs = Blog::orderBy('created_at', 'DESC')->where('category_id', $category->id)->get();        
        $categories = Category::all();
        $category_name = Category::where('id', $category->id)->get();
        return view('categories.show', compact('blogs', 'category_name', 'categories'));
    }

}

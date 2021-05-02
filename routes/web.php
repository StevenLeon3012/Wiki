<?php

use App\Http\Controllers\Blog_TypeController;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\RecordController;
use App\Models\Blog;
use App\Models\Record;
use App\Models\User;
  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
Route::get('/', function () {
    if(Auth::check()){
        $blogs = Blog::latest()->paginate(5);
        return view('blogs.index', compact('blogs'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }else{
    return view('auth.login');
    }
});

Route::any('/searchUser',function(){
    $q = Request::get('q');
    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0) {
        return view('users/index')->withDetails($user)->withQuery ( $q );
    }else {
        $Vacio = "No hay resultados";
        return view ('users/index')->with('vacio', $Vacio)->withQuery ( $q );
    } 
}); 

Route::any('/searchBlog',function(){
    $q = Request::get('q');
    $blog = Blog::where('title', 'LIKE', '%' . $q. '%')->get();
    if(count($blog) > 0) {
        return view('blogs/index')->withDetails($blog)->withQuery ( $q );
    } else {
        $Vacio = "No hay resultados";
        return view ('blogs/index')->with('vacio', $Vacio)->withQuery ( $q );
    }
}); 
Route::any('/searchRecord',function(){
    $q = Request::get('q');
    $record = Record::where('modifier','LIKE','%'.$q.'%')->orWhere('created_at','LIKE','%'.$q.'%')->get();
    if(count($record) > 0) {
        return view('records/index')->withDetails($record)->withQuery ( $q );
    }else {
        $Vacio = "No hay resultados";
        return view ('records/index')->with('vacio', $Vacio)->withQuery ( $q );
    } 
}); 

  
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('blog_type', Blog_TypeController::class);
    Route::resource('records', RecordController::class);
});
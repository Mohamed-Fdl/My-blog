<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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



Route::get('/',[PostController::class,'index'])->name('home');

Route::get('/category/{category}',[PostController::class,'index'])->name('home_c');

Route::get('/{slug}',[PostController::class,'show'])->name('show');

Route::post('/search',[PostController::class,'search'])->name('search');

Route::post('/newcomment',[PostController::class,'store_comment'])->name('newcomment');


///Admin routes
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/addPost', function () {
        return view('admin.posts.addpost');
    })->name('newpost');

    Route::post('/newpost',[PostController::class,'store'])->name('addpost');

    Route::get('/admin/addCategory', function () {
        // dd(session('connect'));
        return view('admin.category.index');
    })->name('newcategory');

    Route::get('/admin/delPost/{id}', function ($id) {
        Post::where('id',$id)->delete();
        return back();
    })->name('delPost');

    Route::get('/admin/posts', [PostController::class,'seeAll'])->name('all');

    Route::post('/newcategory',[CategoryController::class,'store'])->name('addcategory');

    Route::get('/delCategory/{id}', function ($id) {
        Category::where('id',$id)->delete();
        return back();
    })->name('delcategory');

    Route::get('/admin/editPosts/{id}', function ($id) {
        return view('admin.posts.edit',['id'=>$id]);
    })->name('newedit');

    Route::post('/editPost/{id}',[PostController::class,'edit'])->name('edit');
});






///Admin connexion
Route::get('/admin/login',function(){
    return view('admin.connect');
});

Route::post('/admin/connect',[AdminController::class,'connect'])->name('admin_login');



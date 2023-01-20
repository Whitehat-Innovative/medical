<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function ()

 {

    if (Auth::user()->code=='007') {
        return view('dashboard');
    }
    if (Auth::user()->code=='008') {
        return view ('staff-dashboard');
    }
    if(Auth::user()->code =='009')
    {
        return view('user-dashboard');
    }



})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {

    /*Blogs Route  */
    Route::get('/addpost/view', [PostController::class,'blog'])->name('blog');
    Route::get('/editpost/{}/view', [PostController::class, 'editpostview'])->name('blog.edit.view');

    Route::post('/addpost', [PostController::class,'addpost'])->name('blog.add');
    Route::post('/editpost', [PostController::class, 'editpost'])->name('blog.edit');
    Route::post('/deletepost/{}', [PostController::class, 'destroypost'])->name('blog.delete');

    Route::get('/postlist', [PostController::class, 'allpost'])->name('blog.list');


    /* Research route */
    Route::get('/addresearch/view', [PostController::class,'research'])->name('research');
    Route::get('/editresearch/{}/view', [PostController::class, 'editresearchview'])->name('research.edit.view');

    Route::post('/addresearch', [PostController::class,'addresearch'])->name('research.add');
    Route::post('/editresearch', [PostController::class, 'editresearch'])->name('research.edit');
    Route::post('/deleteresearch/{}', [PostController::class, 'destroyresearch'])->name('research.delete');

    Route::get('/researchlist', [PostController::class, 'allresearch'])->name('research.list');

    /* All Users Route */
    Route::get('/allusers', [UserController::class, 'allusers'])->name('view.user');

    Route::post('/delete/{users}', [UserController::class, 'destroy'])->name('delete');
    Route::get('/edit/{users}/view', [UserController::class, 'edituserview'])->name('edit.view');
    Route::post('/edit/{users}', [UserController::class, 'edit'])->name('edit.user');

    /* Category/Tags */

    Route::get('/cat-tag', [PostController::class, 'CatTag'])->name('cat.tag.view');
    Route::post('/add/cat-tag', [PostController::class, 'addCatTag'])->name('cat.tag.add');




});

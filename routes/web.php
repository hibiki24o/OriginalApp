<?php

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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use Monolog\Handler\RotatingFileHandler;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::post('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');

    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

    Route::get('/admin/edit/{id}', [AdminController::class, 'adminEdit'])->name('admin.edit');
    Route::post('/admin/edit/{id}', [AdminController::class, 'adminEditForm']);
    Route::post('/admin/edit/{id}', [AdminController::class, 'updateDelFlag'])->name('admin.updateDelFlag');

    Route::get('/home', [PostController::class, 'index'])->name('home');


    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/create', [PostController::class, 'store']);

    Route::get('/mypage/edit/{post}', [AdminController::class, 'edit'])->name('mypage.edit');
    Route::put('/mypage/edit/{post}', [AdminController::class, 'update'])->name('mypage.update');

    Route::group(['middleware' => 'can:view,post'], function () {
        Route::get('/create/{post}/detail', [PostController::class, 'postDetail'])->name('post.detail');
    });
    Route::group(['middleware' => 'can:view,comment'], function () {
        Route::get('/create/{comment}/detail', [PostController::class, 'commentDetail'])->name('comment.detail');
    });

    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

    Route::delete('/mypage/delete/{post}', [AdminController::class, 'deleteAdmin'])->name('mypage.delete');

    Route::post('/edit_up/{post}', [AdminController::class, 'postsUpdate'])->name('posts.update');
    Route::get('/edit_up/{post}', [AdminController::class, 'editUpdate'])->name('posts.update');
    Route::get('/user/edit-icon', [AdminController::class, 'editIcon'])->name('user.editIcon');
    Route::post('/user/update-icon', [AdminController::class, 'updateIcon'])->name('user.updateIcon');
    Route::delete('/user/delete', [AdminController::class, 'destroy'])->name('user.destroy');


    Route::post('/comment/{post}', [PostController::class, 'postsCommentForm'])->name('posts.comment.form');
    Route::get('/comment/{post}', [PostController::class, 'postsComment'])->name('posts.comment');

    // Route::post('/admin', [AdminController::class, 'adminForm'])->name('admin.form');
    Route::resource('report', 'ReportController');
});

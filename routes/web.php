<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'login'])->name('admin.login');
Route::post('auth', [AdminController::class, 'auth'])->name('admin.auth');
Route::middleware('admin')->get('/admin', function () {
    return view('dashboard');
});


Route::prefix('admin')->group(function () {


    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    //tags routes
    Route::resource('tags', TagController::class, [
        'names' => [
            'index' => 'admin.tags.index',
            'create' => 'admin.tags.create',
            'store' => 'admin.tags.store',
            'edit' => 'admin.tags.edit',
            'update' => 'admin.tags.update',
            'destroy' => 'admin.tags.destroy',
        ]
    ]);
    //articles routes
    Route::get('articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('edit/{article}/{published}/articles', [ArticleController::class, 'tooglePublishedStatus'])->name('admin.articles.edit');
    Route::delete('delete/{article}/articles', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
    //user routes
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('delete/{user}/users', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

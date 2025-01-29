<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryTagController;
use App\Http\Controllers\SubCategoryTagController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::middleware('auth')->group( function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::prefix("member")->group(function() {
        Route::get('/create', [HomeController::class, 'create'])->name('member.create');
        Route::get('/{id}/edit', [HomeController::class, 'edit'])->name('member.edit');
        Route::post('/save', [HomeController::class, 'save'])->name('member.save');
        Route::get('/{id}/delete', [HomeController::class, 'delete'])->name('member.delete');
    });

    Route::prefix("category-tag")->group(function() {
        Route::get('/', [CategoryTagController::class, 'index'])->name('category-tag');
        Route::get('/create', [CategoryTagController::class, 'create'])->name('category-tag.create');
        Route::get('/{id}/edit', [CategoryTagController::class, 'edit'])->name('category-tag.edit');
        Route::post('/save', [CategoryTagController::class, 'save'])->name('categoryTag.save');
        Route::get('/{id}/delete', [CategoryTagController::class, 'delete'])->name('category-tag.delete');
    });

    Route::prefix("sub-category-tag")->group(function() {
        Route::get('/', [SubCategoryTagController::class, 'index'])->name('sub-category-tag');
        Route::get('/create', [SubCategoryTagController::class, 'create'])->name('sub-category-tag.create');
        Route::get('/{id}/edit', [SubCategoryTagController::class, 'edit'])->name('sub-category-tag.edit');
        Route::post('/save', [SubCategoryTagController::class, 'save'])->name('sub-category-tag.save');
        Route::get('/{id}/delete', [SubCategoryTagController::class, 'delete'])->name('sub-category-tag.delete');
    });
});

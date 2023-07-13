<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;

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

//Route::get('/categories',[CategoryController::class,'index'])
//->name('categories.index');
//
//Route::get('/categories/{id}',[CategoryController::class,'show']);
//
//Route::get('/categories/create',[CategoryController::class,'create']);
//
//Route::get('/categories/{id}/edit',[CategoryController::class,'edit']);
//Route::post('/categories/store',[CategoryController::class,'store']);
//
//Route::put('/categories/{id}/update',[CategoryController::class,'update']);
//
//Route::delete('/categories/{id}',[CategoryController::class,'destroy']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/changeLang/{lang}', function (string $locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name("changeLang");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


//    My middle where
    Route::get('/',[PostController::class,'index'])
        ->name('posts');

    Route::get('/carts',[PostController::class,'carts']);

    Route::resource('categories',
        CategoryController::class);
    Route::resource('brands',
        \App\Http\Controllers\BrandController::class);


    Route::get('products/trashed', [ProductController::class, 'deleted_index'])->name('products.trashed');
    Route::get('products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    Route::resource('products',
        ProductController::class);
    Route::resource('products',
        \App\Http\Controllers\ProductController::class);

    Route::get('users/export/', [UserController::class, 'export'])->name('users.export');

    Route::resource('users',
        \App\Http\Controllers\UserController::class);

    Route::resource('roles',
        \App\Http\Controllers\RoleController::class);
    Route::resource('roles',
        RoleController::class);
    Route::get('/sendemail',function(){
        Mail::to('mr.numberone312@gmail.com')->send(new TestEmail(['title'=>'LaravelCourse','name'=>auth()->user()->name]));
        return '<h1>email sent</h1>';
    });



});

require __DIR__.'/auth.php';

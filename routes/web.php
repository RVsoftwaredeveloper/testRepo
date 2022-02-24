<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\AjaxBOOKCRUDController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MainController;



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
Route::resource("products",ProductController::class);

Route::get('file-upload', [ProductController::class, 'index']);
Route::get('products/delete/{id?}', [ProductController::class, 'destroy'])->name('productDelete');
Route::post('store', [ProductController::class, 'store']);
Route::delete('myproducts/{id}', [ProductController::class, 'destroy']);
Route::delete('myproductsDeleteAll', [ProductController::class, 'deleteAll']);
// Route::get('get-form', 'ContactController@create');
// Route::post('submit-form', 'ContactController@store');
Route::get('ajax-book-crud', [AjaxBOOKCRUDController::class, 'index'])->name('ajax-book-crud');
Route::post('add-update-book', [AjaxBOOKCRUDController::class, 'store']);
Route::post('edit-book', [AjaxBOOKCRUDController::class, 'edit']);
Route::get('update-status', [AjaxBOOKCRUDController::class, 'updateStatus']);
Route::post('delete-book', [AjaxBOOKCRUDController::class, 'destroy']);
// Route::post('submit-form', 'ContactController@store');
Route::get('ajax-product-crud', [ProductController::class, 'index'])->name('products');
Route::post('add-update-product', [ProductController::class, 'store']);
Route::post('edit-product', [ProductController::class, 'edit']);
Route::post('delete-product', [ProductController::class, 'destroy']);
Route::get("relation",[AjaxBOOKCRUDController::class,'relation']);
Route::get('register', [RegisterController::class, 'register']);
Route::post('register', [RegisterController::class, 'store'])->name('register');
Route::get('login', [LoginController::class, 'login']);
Route::post('login', [LoginController::class, 'store'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('home', [LoginController::class, 'home'])->name('home');
Route::get('forget-password', [ForgotPasswordController::class, 'getEmail']);
Route::post('forget-password', [ForgotPasswordController::class, 'postEmail']);
Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword']);
Route::get('file-upload', [ProductController::class, 'index']);
Route::get('index', [MainController::class, 'index'])->name('index');


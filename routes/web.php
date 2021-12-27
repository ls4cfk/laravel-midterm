<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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


Route::get('/', [AdminController::class , 'mainpage']);

Route::get('/admin',[AdminController::class , 'viewItem']);

Route::get('admin/viewfood', function(){
    return view("admin.additem");
});

Route::post('savemenu',[AdminController::class , 'saveMenuItem']);

Route::get('edititem/{id}',[AdminController::class , 'getEditItem']);
Route::get('deleteitem/{id}',[AdminController::class , 'deleteItem']);

Route::get('allitem/{id}',[AdminController::class , 'getAllItem']);
Route::post('savedititem',[AdminController::class , 'editItem']);

Route::post('search',[AdminController::class , 'searchItem']);
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

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get("/logout", "SessionsController@destroy");

Route::post("/register", "RegistrationController@store");
Route::post("/login", "SessionsController@store");

Route::get("/users/{id}", "UsersController@show");
Route::post("/users/{id}", "UsersController@updateAvatar");

Route::post("/upload", "FilesController@store");

Route::get("/files/{id}", "FilesController@show");

Route::get("/download/{id}/{originalName}", "FilesController@downloadFile");


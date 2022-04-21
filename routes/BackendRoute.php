<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;


//category route

Route::get('/categories',[CategoryController::class,"index"])->name("categories.index");
Route::get('/categories/create',[CategoryController::class,"create"])->name("categories.create");
Route::post('/categories/{category:slug?}',[CategoryController::class,"store"])->name("categories.store");
Route::get('/categories/{category:slug}',[CategoryController::class,"show"])->name("categories.show");
Route::get('/categories/{category:slug}/edit',[CategoryController::class,"edit"])->name("categories.edit");
Route::delete('/categories/{category:slug}',[CategoryController::class,"destroy"])->name("categories.destroy");

//post route

Route::get('/posts',[PostController::class,"index"])->name("posts.index");
Route::get('/posts/create',[PostController::class,"create"])->name("posts.create");
Route::post('/posts/{post:slug?}',[PostController::class,"store"])->name("posts.store");
Route::get('/posts/{post:slug}',[PostController::class,"show"])->name("posts.show");
Route::get('/posts/{post:slug}/edit',[PostController::class,"edit"])->name("posts.edit");
Route::delete('/posts/{post:slug}',[PostController::class,"destroy"])->name("posts.destroy");

//event route
Route::get('/events',[EventController::class,"index"])->name("events.index");
Route::get('/events/create',[EventController::class,"create"])->name("events.create");
Route::post('/events/{event:slug?}',[EventController::class,"store"])->name("events.store");
Route::get('/events/{event:slug}',[EventController::class,"show"])->name("events.show");
Route::get('/events/{event:slug}/edit',[EventController::class,"edit"])->name("events.edit");
Route::delete('/events/{event:slug}',[EventController::class,"destroy"])->name("events.destroy");

//video route
Route::get('/videos',[VideoController::class,"index"])->name("videos.index");
Route::get('/videos/create',[VideoController::class,"create"])->name("videos.create");
Route::post('/videos/{video:slug?}',[VideoController::class,"store"])->name("videos.store");
Route::get('/videos/{video:slug}',[VideoController::class,"show"])->name("videos.show");
Route::get('/videos/{video:slug}/edit',[VideoController::class,"edit"])->name("videos.edit");
Route::delete('/videos/{video:slug}',[VideoController::class,"destroy"])->name("videos.destroy");


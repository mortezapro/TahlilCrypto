<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/{post:slug}',[PostController::class,"show"])->name("posts.show");
Route::post('/comments/{comment:id?}',[CommentController::class,"store"])->name("comments.store");

<?php

use App\Http\Controllers\CacheController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchHistoryController;
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

//comment route
Route::get('/comments',[CommentController::class,"index"])->name("comments.index");
Route::get('/comments/create',[CommentController::class,"create"])->name("comments.create");
Route::post('/comments/{comment:slug?}',[CommentController::class,"store"])->name("comments.store");
Route::get('/comments/{comment:slug}',[CommentController::class,"show"])->name("comments.show");
Route::get('/comments/{comment:slug}/edit',[CommentController::class,"edit"])->name("comments.edit");
Route::delete('/comments/{comment:slug}',[CommentController::class,"destroy"])->name("comments.destroy");

//comment route
Route::get('/themes',[CommentController::class,"index"])->name("themes.index");
Route::get('/themes/create',[CommentController::class,"create"])->name("themes.create");
Route::post('/themes/{theme:name?}',[CommentController::class,"store"])->name("themes.store");
Route::get('/themes/{theme:name}',[CommentController::class,"show"])->name("themes.show");
Route::get('/themes/{theme:name}/edit',[CommentController::class,"edit"])->name("themes.edit");
Route::delete('/themes/{theme:name}',[CommentController::class,"destroy"])->name("themes.destroy");

//search history route
Route::get('/search-histories',[SearchHistoryController::class,"index"])->name("search-histories.index");
Route::get('/search-histories/create',[SearchHistoryController::class,"create"])->name("search-histories.create");
Route::post('/search-histories/{search-history:slug?}',[SearchHistoryController::class,"store"])->name("search-histories.store");

//Permission route
Route::get('/permissions',[PermissionController::class,"index"])->name("permissions.index");
Route::get('/permissions/create',[PermissionController::class,"create"])->name("permissions.create");
Route::post('/permissions/{permission:slug?}',[PermissionController::class,"store"])->name("permissions.store");
Route::get('/permissions/{permission:slug}',[PermissionController::class,"show"])->name("permissions.show");
Route::get('/permissions/{permission:slug}/edit',[PermissionController::class,"edit"])->name("permissions.edit");
Route::delete('/permissions/{permission:slug}',[PermissionController::class,"destroy"])->name("permissions.destroy");

Route::post('/permissions/assign-to-role/{role:name}',[PermissionController::class,"assignToRole"])->name("permissions.assign.to.role");
Route::post('/permissions/refresh-role/{role:name}',[PermissionController::class,"refreshRole"])->name("permissions.refresh.role");
Route::post('/permissions/assign-to-user/{user}',[PermissionController::class,"assignToUser"])->name("permissions.assign.to.user");
Route::post('/permissions/refresh-user/{user}',[PermissionController::class,"refreshUser"])->name("Permissions.refresh.user");

// Roles route
Route::get('/roles',[RoleController::class,"index"])->name("roles.index");
Route::get('/roles/create',[RoleController::class,"create"])->name("roles.create");
Route::post('/roles/{role:slug?}',[RoleController::class,"store"])->name("roles.store");
Route::get('/roles/{role:slug}',[RoleController::class,"show"])->name("roles.show");
Route::get('/roles/{role:slug}/edit',[RoleController::class,"edit"])->name("roles.edit");
Route::delete('/roles/{role:slug}',[RoleController::class,"destroy"])->name("roles.destroy");

Route::post('/roles/assign-to-user/{user}',[RoleController::class,"assignToUser"])->name("roles.assign.to.user");
Route::post('/roles/refresh-roles/{user}',[RoleController::class,"refreshRoles"])->name("refreshRoles");








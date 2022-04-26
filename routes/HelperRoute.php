<?php

use App\Http\Controllers\CacheController;
use Illuminate\Support\Facades\Route;

// cache route
Route::get('/clear-cache',[CacheController::class,"clearCache"])->name("clear.cache");
Route::get('/clear-route',[CacheController::class,"clearRouteCache"])->name("clear.route");
Route::get('/clear-view',[CacheController::class,"clearViewCache"])->name("clear.cache");
Route::get('/clear-config',[CacheController::class,"clearConfigCache"])->name("clear.config");
Route::get('/optimize',[CacheController::class,"optimize"])->name("clear.optimize");
Route::get('/clear-all',[CacheController::class,"clearAll"])->name("clear.all");

Route::get('/show-token',function (){
    return csrf_token();
});



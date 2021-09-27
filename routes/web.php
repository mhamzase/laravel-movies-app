<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TVController;
use Illuminate\Support\Facades\Route;


// Movies
Route::get('/',[MoviesController::class,'index'])->name('movies.index');
Route::get('/movies/{movie}',[MoviesController::class,'show'])->name('movies.show');


// Actors
Route::get('/actors',[ActorController::class,'index'])->name('actors.index');
Route::get('/actors/page/{page?}',[ActorController::class,'index']);

Route::get('/actors/{actor}',[ActorController::class,'show'])->name('actors.show');


// TV Shows
Route::get('/tv',[TVController::class,'index'])->name('tv.index');
Route::get('/tv/{movie}',[TVController::class,'show'])->name('tv.show');
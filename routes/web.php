<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);
Route::get('/login', Login::class);
Route::get('/register', Register::class);

/*Route::get('/', function () {
    return view('welcome');
});*/

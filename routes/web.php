<?php

use Illuminate\Support\Facades\Route;
use App\Answers\Feat4\ProductsController;
use App\Answers\Feat5\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductsController::class, 'index']);

Route::get('/register', [RegisterController::class, 'getForm'])->name('register.get');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

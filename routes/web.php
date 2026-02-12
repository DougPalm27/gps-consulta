<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GpsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// GPS (MVC correcto)
Route::get('/gps', [GpsController::class, 'index']);
Route::post('/gps', [GpsController::class, 'store']);

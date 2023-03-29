<?php

use App\Http\Controllers\LinksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('links.create');
});

Route::get('/links/{token}', [LinksController::class, 'show'])->name('links.show');
Route::post('/links', [LinksController::class, 'createLink'])->name('links.create');
Route::get('/{token}', [LinksController::class, 'redirect'])->name('links.redirect');

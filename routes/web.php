<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduktuController;

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
    return redirect()->route('produktuak.index');
});

Route::resource('produktuak', ProduktuController::class);

Route::get('/produktuak-vue', function () {
    return view('produktuak.vue');
})->name('produktuak.vue');

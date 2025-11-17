<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProduktuApiController;

// Endpoint de verificación rápida
Route::get('ping-produk', fn() => response()->json(['ping' => 'ok']));

// CRUD REST de productos con binding singular personalizado
Route::apiResource('produktuak', ProduktuApiController::class)
	->parameters(['produktuak' => 'produktua']);

// Endpoint adicional directo por id numérico (alternativa a /api/produktuak/{id})
Route::get('produktuak/simple/{id}', [ProduktuApiController::class, 'simple']);
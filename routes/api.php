<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuscaCnpjController;
use App\Http\Controllers\FornecedorController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('fornecedores')->group(function () {
    Route::get('/', [FornecedorController::class, 'index']);
    Route::post('/', [FornecedorController::class, 'store']);
    Route::get('/{fornecedor}', [FornecedorController::class, 'show']);
    Route::put('/{fornecedor}', [FornecedorController::class, 'update']);
    Route::delete('/{fornecedor}', [FornecedorController::class, 'destroy']);
});

Route::get('busca-cnpj/{cnpj}', [BuscaCnpjController::class, 'buscar']);

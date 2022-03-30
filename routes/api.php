<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotacaoController;

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

//Route::post('cotacao', 'CotacaoController@criarStudent');

Route::post('cotacao', [CotacaoController::class, 'criarCotacao']);


Route::put('cotacao', [CotacaoController::class, 'solicitarCotacao']);

Route::get('cotacao', [CotacaoController::class, 'obterCotacoesFrete']);
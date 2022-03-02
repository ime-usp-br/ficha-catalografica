<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FichaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('ficha');
});

Route::post('/ficha', [FichaController::class, 'montarFicha']);
Route::get('/ficha/pdf/{texto}', [FichaController::class, 'visualizarPdf']);
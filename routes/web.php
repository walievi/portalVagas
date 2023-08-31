<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('web')->resource('curriculo', Controllers\CurriculoController::class);

Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('login');

Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('autenticacao.login');
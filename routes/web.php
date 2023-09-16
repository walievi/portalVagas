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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/vagas', [Controllers\VagasController::class, 'index'])->name('vagas');

Route::get('/users', [Controllers\UsersController::class, 'index'])->name('users');

Route::delete('/users/{id}', [Controllers\UsersController::class, 'destroy'])->name('users.destroy');



Route::middleware('web')->resource('curriculo', Controllers\CurriculoController::class);

// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('login');

// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('autenticacao.login');

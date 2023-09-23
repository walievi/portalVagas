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

Route::get('/', [Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    // Rotas de administração aqui
    Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
        Route::get('/users', [Controllers\UsersController::class, 'index'])->name('users');
    });

    Route::get('/formCreate', [Controllers\UsersController::class, 'formCreate'])->name('formCreate');

    Route::post('/create', [Controllers\UsersController::class, 'create'])->name('create');

    Route::delete('/users/{id}', [Controllers\UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}', [Controllers\UsersController::class, 'restore'])->name('users.restore');

    Route::get('/formEdit/{id}', [Controllers\UsersController::class, 'formEdit'])->name('formEdit');

    Route::put('/edit/{id}', [Controllers\UsersController::class, 'edit'])->name('edit');

    Route::get('/profile', [Controllers\UsersController::class, 'profile'])->name('profile');

    Route::put('/editProfile/{id}', [Controllers\UsersController::class, 'editProfile'])->name('editProfile');

    Route::middleware('web')->resource('curriculo', Controllers\CurriculoController::class);

    # rotas para módulo vagas

    Route::get('/vagas', [Controllers\VagasController::class, 'index'])->name('vagas');

    Route::get('/formCreateVagas', [Controllers\VagasController::class, 'formCreateVagas'])->name('formCreateVagas');

    Route::post('/createVaga', [Controllers\VagasController::class, 'create'])->name('createVaga');

    Route::delete('/vagas/{id}', [Controllers\VagasController::class, 'destroy'])->name('vagas.destroy');

    Route::put('/editVaga/{id}', [Controllers\VagasController::class, 'editVaga'])->name('editVaga');

    Route::get('/formEditVagas/{id}', [Controllers\VagasController::class, 'formEditVagas'])->name('formEditVagas');

    # rotas para módulo formulários

    Route::get('/perguntas', [Controllers\PerguntasController::class, 'index'])->name('perguntas');

    Route::get('/formCreatePergunta', [Controllers\PerguntasController::class, 'formCreatePergunta'])->name('formCreatePergunta');

    Route::post('/createPergunta', [Controllers\PerguntasController::class, 'create'])->name('createPergunta');

    Route::delete('/perguntas/{id}', [Controllers\PerguntasController::class, 'destroy'])->name('perguntas.destroy');

    Route::put('/editPergunta/{id}', [Controllers\PerguntasController::class, 'editPergunta'])->name('editPergunta');

    Route::get('/formEditPerguntas/{id}', [Controllers\PerguntasController::class, 'formEditPerguntas'])->name('formEditPerguntas');

});


// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('login');

// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('autenticacao.login');

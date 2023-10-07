<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

use App\Http\Controllers\PerguntaController;

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

    Route::get('/cidades/{estado_id}', [Controllers\UsersController::class, 'cidadesPorEstado'])->name('cidadesPorEstado');

    # rota para editar perfil dados padrão, nome, senha, email
    Route::put('/editProfile/{id}', [Controllers\UsersController::class, 'editProfile'])->name('editProfile');

    # rota para editar dados pessoais
    Route::put('/editDadosPessoais/{id}', [Controllers\UsersController::class, 'editDadosPessoais'])->name('editDadosPessoais');

    Route::middleware('web')->resource('curriculo', Controllers\CurriculoController::class);

    # rotas para módulo vagas

    Route::get('/vagas', [Controllers\VagasController::class, 'index'])->name('vagas');

    Route::get('/formCreateVagas', [Controllers\VagasController::class, 'formCreateVagas'])->name('formCreateVagas');

    Route::post('/createVaga', [Controllers\VagasController::class, 'create'])->name('createVaga');

    Route::delete('/vagas/{id}', [Controllers\VagasController::class, 'destroy'])->name('vagas.destroy');

    Route::put('/editVaga/{id}', [Controllers\VagasController::class, 'editVaga'])->name('editVaga');

    Route::get('/formEditVagas/{id}', [Controllers\VagasController::class, 'formEditVagas'])->name('formEditVagas');



    # rotas para perguntas
    Route::name('pergunta.')->prefix('pergunta')->group(function () {
        $class = PerguntaController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('show')    ->get('{pergunta}',      [$class, 'show']);
        Route::name('edit')    ->get('{pergunta}/edit', [$class, 'edit']);
        Route::name('store')   ->post('',               [$class, 'store']);
        Route::name('update')  ->put('{pergunta}',      [$class, 'update']);
        Route::name('destroy') ->delete('{pergunta}',   [$class, 'destroy']);
    });
});


// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('login');

// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('autenticacao.login');

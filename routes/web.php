<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\CandidatoController;

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


   


    # rotas para vagas
    Route::name('vaga.')->prefix('vagas')->group(function () {
        $class = Controllers\VagasController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('show')    ->get('{vaga}',      [$class, 'show']);
        Route::name('edit')    ->get('{vaga}/edit', [$class, 'edit']);
        Route::name('store')   ->post('',               [$class, 'store']);
        Route::name('update')  ->put('{vaga}',      [$class, 'update']);
        Route::name('destroy') ->delete('{vaga}',   [$class, 'destroy']);
    });



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


    # rotas do perfil do candidado
    Route::name('candidato.')->prefix('candidato')->group(function () {
        $class = Controllers\CandidatoController::class;
        Route::name('index')   ->get('',          [$class, 'index']);
        Route::name('edit')    ->get('/edit',     [$class, 'edit']);
        Route::name('update')  ->put('{candidato}',      [$class, 'update']);
    });

    # rotas para perfil
    Route::name('perfil.')->prefix('perfil')->group(function () {
        $class = Controllers\PerfilController::class;
        Route::name('store')   ->post('',        [$class, 'store']);
        Route::name('update')  ->put('{perfil}', [$class, 'update']);
    });

    # rotas para formações
    Route::name('formacao.')->prefix('formacao')->group(function () {
        $class = Controllers\FormacaoController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('show')    ->get('{formacao}',      [$class, 'show']);
        Route::name('edit')    ->get('{formacao}/edit', [$class, 'edit']);
        Route::name('store')   ->post('',               [$class, 'store']);
        Route::name('update')  ->put('{formacao}',      [$class, 'update']);
        Route::name('destroy') ->delete('{formacao}',   [$class, 'destroy']);
    });

    # rotas para curriculos
    Route::name('curriculo.')->prefix('curriculo')->group(function () {
        $class = Controllers\CurriculoController::class;
        Route::name('store')   ->post('',        [$class, 'store']);
        Route::name('update')  ->put('{curriculo}', [$class, 'update']);
        Route::name('show')->get('show/{curriculo}', [$class, 'show']);
    });

    # rotas para candidatar-se
    Route::name('candidatar.')->prefix('candidatar')->group(function () {
        $class = Controllers\CandidatarController::class;
        Route::name('index')->get('{vaga}', [$class, 'index']); 
        Route::name('store')   ->post('',        [$class, 'store']);
        Route::name('update')  ->put('{candidatar}', [$class, 'update']);
    });

    # rotas para curriculosVaga
    Route::name('curriculosVaga.')->prefix('curriculosVaga')->group(function () {
        $class = Controllers\CurriculosVagaController::class;
        Route::name('index')->get('{vaga}', [$class, 'index']); 
        Route::name('show')->get('{vaga}/{user}', [$class, 'show']); 
        Route::name('update')->post('', [$class, 'update']); 
        Route::name('mail')->post('{vaga}/{user}', [$class, 'mail']);
    });

    # rotas para feedback
    Route::name('feedback.')->prefix('feedback')->group(function () {
        $class = Controllers\FeedbackController::class;
        Route::name('index')->get('', [$class, 'index']); 
        Route::name('store')   ->post('',        [$class, 'store']);
        Route::name('update')  ->put('{feedback}', [$class, 'update']);
    });



});


// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('login');

// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('autenticacao.login');
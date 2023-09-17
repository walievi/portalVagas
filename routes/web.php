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

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    // Rotas de administração aqui

    Route::get('/vagas', [Controllers\VagasController::class, 'index'])->name('vagas');

    Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
        Route::get('/users', [Controllers\UsersController::class, 'index'])->name('users');
    });
    
    
    Route::get('/formCreate', [Controllers\UsersController::class, 'formCreate'])->name('formCreate');
    
    Route::post('/create', [Controllers\UsersController::class, 'create'])->name('create');
    
    Route::delete('/users/{id}', [Controllers\UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('/formEdit/{id}', [Controllers\UsersController::class, 'formEdit'])->name('formEdit');

    Route::put('/edit/{id}', [Controllers\UsersController::class, 'edit'])->name('edit');

    Route::get('/profile', [Controllers\UsersController::class, 'profile'])->name('profile');

    Route::put('/editProfile/{id}', [Controllers\UsersController::class, 'editProfile'])->name('editProfile');
    
    Route::middleware('web')->resource('curriculo', Controllers\CurriculoController::class);

});


// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('login');

// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('autenticacao.login');

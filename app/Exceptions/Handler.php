<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

        protected function handleDuplicateRecordException(DuplicateRecordException $exception)
    {
        Session::flash('error', $exception->getMessage());
        return back();
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof QueryException) {
            // Verifique se é uma exceção de chave estrangeira (1451 é o código de erro para isso).
            if ($exception->errorInfo[1] === 1451) {
                Session::flash('error', 'Registro possui vínculo e não pode ser deletado.');
                return back();
            }
        }

        //exception para registro duplicado no campo email na criação de um usuário
        if ($exception instanceof \Illuminate\Database\QueryException) {
            if ($exception->errorInfo[1] === 1062) {
                Session::flash('error', 'Email já cadastrado.');
                return back();
            }
        }
 

        return parent::render($request, $exception);
        }
    
    

}

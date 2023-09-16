<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutenticacaoController extends Controller
{
    public function index()
    {
        return view('autenticacao.index');
    }
}

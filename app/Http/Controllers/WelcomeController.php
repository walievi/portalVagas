<?php

namespace App\Http\Controllers;
use App\Models\Vaga;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $vagas = Vaga::all();

        return view('welcome', ['vagas' => $vagas]);
    }
}

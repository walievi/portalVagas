<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vagas;


class VagasController extends Controller
{
    public function index() {
        return view('vagas.index');
    }


    public function create(Request $request) {
        
        view('vagas.index');

        Vagas::create([
            'titulo' => $request->input('titulo'),
            'status' => $request->input('status'),
        ]);


        return redirect()->route('vagas')->with('success', 'Vaga adicionada com sucesso.');




    }
}

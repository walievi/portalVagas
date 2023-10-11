<?php

namespace App\Http\Controllers;

use App\Auth;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Estado;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidato = Candidato::logged();
        return view('dadosPessoais.index', compact('candidato'));
    }
    /**

     * Display the specified resource.
     *
     * @param  \App\Models\Candidato  $curriculo
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $candidato = Candidato::logged();
        $user = $candidato->user;
        $estados = Estado::get();

        return view('dadosPessoais.form', compact('candidato', 'user', 'estados'));
    }

    /**
     * Atualiza uma pergunta existente no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Pergunta  $pergunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pergunta $pergunta)
    {

    }
}

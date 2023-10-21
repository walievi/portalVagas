<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\FormacaoAcademica;
use Illuminate\Http\Request;

class FormacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user(); // Obtém o usuário autenticado

        $formacao->local_medio = $request->input('local_medio');
        $formacao->ano_conclusao_medio = $request->input('ano_conclusao_medio');
        $formacao->curso_superior = $request->input('curso_superior');
        $formacao->universidade_superior = $request->input('universidade_superior');
        $formacao->ano_conclusao_superior = $request->input('ano_conclusao_superior');
        $formacao->data_inicio_superior = $request->input('data_inicio_superior');
        $formacao->user_id = $user->id;
        
        $formacao->save();

        return redirect()->route('profile')->with('success', 'Formação inserida com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CurriculosVaga;
use App\Models\Vaga;
use App\Models\User;
use App\Models\Resposta;
use App\Models\Pergunta;
use App\Models\Feedback;
use App\Models\CandidaturaVaga;

class CurriculosVagaController extends Controller
{
    public function index($id)
    {
        // $curriculos = CurriculosVaga::all()->where('vaga_id', $id);
        $curriculos = CandidaturaVaga::all()->where('vaga_id', $id);
        $vaga = Vaga::find($id);
        $user = User::all();
        // buscar usuario que se candidatou na vaga
        foreach ($curriculos as $curriculo) {
            $user = User::find($curriculo->user_id);
            $feedback = Feedback::where('vaga_id', $id)->where('user_id', $curriculo->user_id)->get()->first();
            $curriculo->user = $user;
        }        

        if (isset($feedback)) {
            $feedback = Feedback::where('vaga_id', $id)->where('user_id', $curriculo->user_id)->get()->first();
        } else {
            $feedback = null;
        }

        return view('curriculosVaga.index', compact('curriculos', 'vaga', 'user', 'feedback'));
    }

    public function show($id_vaga, $id_user) {
        $curriculos = CurriculosVaga::all()->where('vaga_id', $id_vaga)->where('user_id', $id_user);
        $vaga = Vaga::find($id_vaga);
        $user = User::find($id_user);

        // Recupere as perguntas associadas à vaga com o ID igual a $vagaId
        $perguntas = Pergunta::whereHas('vagas', function ($query) use ($id_vaga) {
            $query->where('vaga_id', $id_vaga);
        })->get();       
        
        foreach ($curriculos as $resposta) {
            $user = User::find($resposta->user_id);
            $pergunta = Pergunta::find($resposta->pergunta_id);
            $resposta->user = $user;
        }   

        $listaVagas = Vaga::all();

        $feedback = Feedback::where('vaga_id', $id_vaga)
            ->where('user_id', $id_user)->get()->first();

        return view('curriculosVaga.show', compact('curriculos', 'vaga', 'user', 'perguntas', 'feedback', 'listaVagas'));
    }

    public function update(Request $request) { 

        $candidaturaVaga = new CandidaturaVaga();
        $candidaturaVaga->user_id = $request->user_id;
        $candidaturaVaga->vaga_id = $request->vaga_id;
        $candidaturaVaga->transferencia_vaga = $request->transferencia_vaga_id;
        $candidaturaVaga->save();

        $feedback = new Feedback();
        $feedback->user_id = $request->user_id;
        $feedback->vaga_id = $request->vaga_id;
        $feedback->feedback_avaliacao = 'Candidato transferido para outra vaga';
        $feedback->status_processo = 'Transferido';
        $feedback->save();

        // $curriculos = CurriculosVaga::all()->where('vaga_id', $id);
        $curriculos = CandidaturaVaga::all()->where('vaga_id', $request->vaga_id);
        $vaga = Vaga::find($request->vaga_id);
        $user = User::all();
        // buscar usuario que se candidatou na vaga
        foreach ($curriculos as $curriculo) {
            $user = User::find($curriculo->user_id);
            $feedback = Feedback::where('vaga_id', $request->vaga_id)->where('user_id', $curriculo->user_id)->get()->first();
            $curriculo->user = $user;
        }        

        if (isset($feedback)) {
            $feedback = Feedback::where('vaga_id', $request->vaga_id)->where('user_id', $curriculo->user_id)->get()->first();
        } else {
            $feedback = null;
        }

        return redirect()->route('curriculosVaga.index', compact('curriculos', 'vaga', 'user', 'feedback'))->with('success', 'Candidato transferido com sucesso.');
    }

}

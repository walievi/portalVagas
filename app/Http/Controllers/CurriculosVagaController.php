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
use Illuminate\Support\Facades\Mail;

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

        $feedback = Feedback::where('vaga_id', $id_vaga)
            ->where('user_id', $id_user)->get()->first();

        return view('curriculosVaga.show', compact('curriculos', 'vaga', 'user', 'perguntas', 'feedback'));
    }

    public function mail(Request $request, $id_vaga, $id_user)
    {
        $feedbackTexto = $request->input('retorno');
        $vaga = Vaga::find($id_vaga);
        $user = User::find($id_user);
    
        // Agora você pode usar o $feedbackTexto para enviar junto com o e-mail
        Mail::to($user->email)->send(new \App\Mail\FeedbackVagaEmail($vaga->titulo, $vaga->unidade, $feedbackTexto));
    
        // Redirecione ou retorne uma resposta de acordo com sua lógica.
        return redirect()->route('curriculosVaga.show', ['vaga' => $vaga->id, 'user' => $user->id])->with('success', 'Feedback enviado com sucesso');
    }
    

}

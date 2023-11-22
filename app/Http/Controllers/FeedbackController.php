<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Vaga;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index()
    {
       $feedback = Feedback::all();
    }

    public function store(Request $request)
    {
        $feedback = Feedback::where('vaga_id', $request->vaga_id)
            ->where('user_id', $request->user_id)->get()->first();

        if (!$feedback) {
            $feedback = new Feedback();
        }
    
        $feedback->user_id = $request->user_id;
        $feedback->vaga_id = $request->vaga_id;
        $feedback->feedback_avaliacao = $request->feedback;
        $feedback->status_processo = $request->status_processo;
        $feedback->candidatura_vaga_id = $request->candidatura_vaga_id;
        $feedback->save();

        return redirect()->route('curriculosVaga.index', $feedback->vaga_id )->with('success', 'Feedback enviado com sucesso!');
    }

    public function show($id)
    {
        // $feedback = Feedback::find($id);
        // return view('feedback.show', compact('feedback'));
    }

    public function edit($id)
    {
        // $feedback = Feedback::find($id);
        // return view('feedback.edit', compact('feedback'));
    }

    public function mail(Request $request, $id_vaga, $id_user)
    {
        $feedbackTexto = $request->input('retorno');
        $vaga = Vaga::find($id_vaga);
        $user = User::find($id_user);
    
        Mail::to($user->email)->send(new \App\Mail\FeedbackVagaEmail($vaga->titulo, $vaga->unidade, $feedbackTexto));
    
        return back()->with('success', 'Feedback enviado com sucesso');
    }
    
}

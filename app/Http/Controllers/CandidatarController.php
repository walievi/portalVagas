<?php

namespace App\Http\Controllers;
use App\Auth;
use App\Models\Candidato;
use Illuminate\Http\Request;
use App\Models\Pergunta;
use App\Models\Vaga;
use App\Models\Resposta;
use App\Models\User;
use App\Models\CandidaturaVaga;

class CandidatarController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($vagaId)
    {
        $user = Candidato::logged();
        $userId = auth()->user();
        $vaga = Vaga::find($vagaId);

        // Recupere as perguntas associadas à vaga com o ID igual a $vagaId
        $perguntas = Pergunta::whereHas('vagas', function ($query) use ($vagaId) {
            $query->where('vaga_id', $vagaId);
        })->get();

        //verificar se o usuário já não está candidatado na vaga
        $canditaturaExiste = Resposta::where('user_id', $userId->id)->where('vaga_id', $vaga->id);
        if($canditaturaExiste->count() > 0){
            return redirect()->route('home')->with('error', 'Você já está candidatado nesta vaga.');
        }
        else{
            return view('candidatar.index', compact('user', 'perguntas', 'vaga'));
        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $vaga_id = $request->input('vaga_id'); // Id da vaga
        //$perguntas = $request->input('perguntas'); // Array de IDs das perguntas
        $respostas = $request->input('respostas'); // Array de respostas do formulário

        //validar se respostas é diferente de null
        if($respostas !== null)
        {
            // Percorre as respostas
            foreach ($respostas as $perguntaId => $respostasPorPergunta) {
                // Verifica se as respostas são um array
                if (is_array($respostasPorPergunta)) {
                    // As respostas são um array
                    foreach ($respostasPorPergunta as $resposta) {
                        $respostaModel = new Resposta();
                        $respostaModel->pergunta_id = $perguntaId;
                        $respostaModel->vaga_id = $vaga_id;
                        $respostaModel->user_id = $user->id;
                        $respostaModel->resposta = $resposta;
                        $respostaModel->save();
                    }
                } else {
                    // As respostas não são um array, trata como resposta unica
                    $respostaModel = new Resposta();
                    $respostaModel->pergunta_id = $perguntaId;
                    $respostaModel->vaga_id = $vaga_id;
                    $respostaModel->user_id = $user->id;
                    $respostaModel->resposta = $respostasPorPergunta;
                    $respostaModel->save();
                }
            }
        }
        $candidaturaVaga = new CandidaturaVaga();
        $candidaturaVaga->user_id = $user->id;
        $candidaturaVaga->vaga_id = $vaga_id;
        $candidaturaVaga->transferencia_vaga = null;
        $candidaturaVaga->save();

        return redirect()->route('home')->with('success', 'Candidatura inserida com sucesso.');
    }

    
}

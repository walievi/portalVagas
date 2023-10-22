<?php

namespace App\Http\Controllers;
use App\Auth;
use App\Models\Candidato;
use Illuminate\Http\Request;
use App\Models\Pergunta;
use App\Models\Vaga;
use App\Models\Resposta;
use App\Models\User;
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
        $vaga = Vaga::find($vagaId);

        // Recupere as perguntas associadas à vaga com o ID igual a $vagaId
        $perguntas = Pergunta::whereHas('vagas', function ($query) use ($vagaId) {
            $query->where('vaga_id', $vagaId);
        })->get();

        return view('candidatar.index', compact('user', 'perguntas', 'vaga'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        // Verifique se ja existe um registro de formação para o usuario
        // $candidato = $user->candidato ?? new Candidato();

        $vaga_id = $request->input('vaga_id'); // Id da vaga
        $perguntas = $request->input('perguntas'); // Array de IDs das perguntas
        $respostas = $request->input('respostas'); // Array de respostas do formulário

        // Itera pelas respostas e serializa em JSON antes de armazenar
        foreach ($respostas as $key => $resposta) {
            $pergunta_id = $perguntas[$key];
            $respostaArray = [
                'vaga_id' => $vaga_id,
                'pergunta_id' => $pergunta_id[0],
                'user_id' => $user->id,
                'resposta' => $resposta,
            ];
            // dd($respostaArray);
            Resposta::create($respostaArray);
        }

        return redirect()->route('home')->with('success', 'Candidatura inserida com sucesso.');
    }
}

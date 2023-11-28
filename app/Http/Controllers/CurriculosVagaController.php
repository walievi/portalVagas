<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NivelEstudo;
use Illuminate\Http\Request;
use App\Models\CurriculosVaga;
use App\Models\Vaga;
use App\Models\User;
use App\Models\Resposta;
use App\Models\Pergunta;
use App\Models\Feedback;
use App\Models\CandidaturaVaga;
use App\Models\FiltroCandidatura;
use App\Models\Curriculo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;


class CurriculosVagaController extends Controller
{
    public function index(Vaga $vaga)
    {
        $tags = [
            'Aprovado' => 'bg-primary text-white',
            'Rejeitado' => 'bg-danger text-white',
            'Em análise' => 'bg-info text-white',
            'Contratado' => 'bg-success text-white',
            'Agendar entrevista' => 'bg-warning text-grey',
            'Arquivado' => 'bg-secondary text-white',
            'Transferido' => 'bg-info text-white',
        ];

        $niveis_estudo = NivelEstudo::pluck('nivel', 'id')->toArray();

        return view('curriculosVaga.index', compact('vaga', 'tags', 'niveis_estudo'));
    }

    public function filtro(Request $request,Vaga $vaga)
    {
        $query = FiltroCandidatura::where('vaga_id', $vaga->id);

        $selected = null;
        if($request->nivel_estudo_id){
            $selected = $request->nivel_estudo_id;
            $query->where('nivel_estudo_id', (int) $request->nivel_estudo_id);
        }

        $candidaturas = $query->get();

        $uniqueCandidaturas = collect();
        $seenUserIds = [];

        foreach ($candidaturas as $candidatura) {
            if (!in_array($candidatura->user_id, $seenUserIds)) {
                $uniqueCandidaturas->push($candidatura);
                $seenUserIds[] = $candidatura->user_id;
            }
        }

        $candidaturas = $uniqueCandidaturas;

        $tags = [
            'Aprovado' => 'bg-primary text-white',
            'Rejeitado' => 'bg-danger text-white',
            'Em análise' => 'bg-info text-white',
            'Contratado' => 'bg-success text-white',
            'Agendar entrevista' => 'bg-warning text-grey',
            'Arquivado' => 'bg-secondary text-white',
            'Transferido' => 'bg-info text-white',
        ];

        $niveis_estudo = NivelEstudo::pluck('nivel', 'id')->toArray();

        return view('curriculosVaga.filtro', compact('candidaturas', 'vaga', 'tags', 'niveis_estudo', 'selected'));
    }


    public function show(CandidaturaVaga $candidatura) {
        $listaVagas = Vaga::all();
        return view('curriculosVaga.show', compact('candidatura', 'listaVagas'));
    }


    public function showCurriculo($curriculoId) {
        $curriculoPdfCandidato = Curriculo::where('user_id', $curriculoId)->first();
    
        if (!$curriculoPdfCandidato) {
            abort(404, 'Currículo não encontrado');
        }
    
        $pdfData = $curriculoPdfCandidato->pdf;
        $filename = 'curriculo_' . $curriculoPdfCandidato->user_id . '.pdf';
    
        // Retornar o PDF como resposta
        return response($pdfData, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
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
        $feedback->candidatura_vaga_id = $candidaturaVaga->id;
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

<?php

namespace App\Http\Controllers;
use App\Auth;
use App\Models\Candidato;
use Illuminate\Http\Request;
use App\Models\Pergunta;
use App\Models\Vaga;
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
}

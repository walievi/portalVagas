<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CurriculosVaga;
use App\Models\Vaga;
use App\Models\User;
use App\Models\Resposta;
use App\Models\Pergunta;

class CurriculosVagaController extends Controller
{
    public function index($id)
    {
        $curriculos = CurriculosVaga::all()->where('vaga_id', $id);
        $vaga = Vaga::find($id);
        $user = User::all();
        // buscar usuario que se candidatou na vaga
        foreach ($curriculos as $curriculo) {
            $user = User::find($curriculo->user_id);
            $curriculo->user = $user;

        }        

        return view('curriculosVaga.index', compact('curriculos', 'vaga', 'user'));
    }

    public function show($id_vaga, $id_user) {
        $curriculos = CurriculosVaga::all()->where('vaga_id', $id_vaga)->where('user_id', $id_user);
        $vaga = Vaga::find($id_vaga);
        $user = User::find($id_user);

        // Recupere as perguntas associadas à vaga com o ID igual a $vagaId
        $perguntas = Pergunta::whereHas('vagas', function ($query) use ($id_vaga) {
            $query->where('vaga_id', $id_vaga);
        })->get();        

        return view('curriculosVaga.show', compact('curriculos', 'vaga', 'user', 'perguntas'));
    }

}

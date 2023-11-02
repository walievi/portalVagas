<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CurriculosVaga;
use App\Models\Vaga;
use App\Models\User;
use App\Models\Resposta;

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

}

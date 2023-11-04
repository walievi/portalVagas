<?php

namespace App\Http\Controllers;

use App\Models\Formacao;
use App\Models\NivelEstudo;
use Illuminate\Http\Request;

class FormacaoController extends Controller
{
    public function create()
    {
        $niveis = NivelEstudo::all()->pluck('nivel', 'id');
        return view('formacao.form', compact('niveis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nivel_estudo_id' => 'required',
            'curso' => 'required',
            'instituicao' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'nullable',
            'observacao' => 'nullable',
        ]);

        Formacao::create($data);

        return redirect()->route('profile')->with('statusformacao', 'Formação criada com sucesso!');
    }

    public function edit(Formacao $formacao)
    {
        $niveis = NivelEstudo::all()->pluck('nivel', 'id');
        return view('formacao.form', compact('formacao', 'niveis'));
    }

    public function update(Request $request, Formacao $formacao)
    {
        $data = $request->validate([
            'nivel_estudo_id' => 'required',
            'curso' => 'required',
            'instituicao' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'nullable',
            'observacao' => 'nullable',
        ]);

        $formacao->update($data);

        return redirect()->route('profile')->with('statusformacao', 'Formação atualizada com sucesso!');
    }

    public function destroy(Formacao $formacao)
    {
        $formacao->delete();
        return redirect()->route('profile')->with('statusformacao', 'Formação excluída com sucesso!');
    }
}

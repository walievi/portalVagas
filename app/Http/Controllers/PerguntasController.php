<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pergunta;
use App\Models\Vaga;

class PerguntasController extends Controller
{
    public function index() {

        $perguntas = Pergunta::all();

        return view('perguntas.index', ['perguntas' => $perguntas]);

    }

    public function formCreatePergunta()
    {
        // Direcionar para página de criar Pergunta
        $vagas = Vaga::all();

        return view('perguntas.create', ['vagas' => $vagas]);
    }

    public function destroy($id)
    {
        // Lógica para excluir a Pergunta com o ID fornecido
        $perguntas = Pergunta::find($id);

        if (!$perguntas) {
            return redirect()
                ->route('perguntas')
                ->with('error', 'Pergunta não encontrada.');
        }

        $perguntas->delete();

        return redirect()
            ->route('perguntas')
            ->with('success', 'Pergunta excluída com sucesso.');
    }

    public function formEditPerguntas($id)
    {
        // Lógica para editar a Pergunta com o ID fornecido
        $perguntas = Pergunta::find($id);

        if (!$perguntas) {
            return redirect()
                ->route('perguntas')
                ->with('error', 'Pergunta não encontrada.');
        }

        return view('perguntas.edit', compact('perguntas'));
    }

    public function editPergunta(Request $request, $id)
    {
        // Lógica para editar a Pergunta com o ID fornecido
        $perguntas = Pergunta::find($id);

        if (!$perguntas) {
            return redirect()
                ->route('perguntas')
                ->with('error', 'Pergunta não encontrada.');
        }

        $perguntas->pergunta = $request->input('pergunta');
        $perguntas->options = $request->input('options');
        $perguntas->mult_resps = $request->input('mult_resps') ?? 0;
        $perguntas->save();

        return redirect()
            ->route('perguntas')
            ->with('success', 'Pergunta editada com sucesso.');
    }

    public function create(Request $request)
    {
        view('perguntas.index');
        

        // Obtenha as opções do formulário como um array
        $options = $request->input('options', []);

        // Converta o array de opções em JSON
        $opcoesJson = json_encode($options);

        $pergunta = new Pergunta([
            'pergunta' => $request->input('pergunta'),
            'options' => $opcoesJson,
            'mult_resps' => $request->input('mult_resps') ?? 0,
        ]);      

        $pergunta->save();
        // Receba as vagas selecionadas do array 'vagas[]'
        $vagasSelecionadas = $request->input('vagas', []);

        // Associe as vagas selecionadas à pergunta
        $pergunta->vagas()->attach($vagasSelecionadas);

        return redirect()
            ->route('perguntas')
            ->with('success', 'Pergunta adicionada com sucesso.');
    }
}

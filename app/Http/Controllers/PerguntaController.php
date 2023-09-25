<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pergunta;
use App\Models\Vaga;

class PerguntaController extends Controller
{
    /**
     * Exibe uma lista de todas as perguntas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perguntas = Pergunta::all();
        return view('pergunta.index', compact('perguntas'));

    }

    /**
     * Mostra o formulário para criar uma nova pergunta.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vagas = Vaga::all();
        return view('pergunta.form', compact('vagas'));
    }

    /**
     * Armazena uma nova pergunta no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'pergunta'   => $request->input('pergunta'),
            'options'    => ($request->input('text_resp') == True ? null : $request->input('options')),
            'mult_resps' => ($request->input('text_resp') == True ? null : ($request->input('mult_resps') == True)),
        ];

        $pergunta = new Pergunta($data);
        $pergunta->save();
        $pergunta->vagas()->attach($request->input('vagas', []));

        return redirect()
            ->route('pergunta.show', ['pergunta' => $pergunta->id])
            ->with('success', 'Pergunta adicionada com sucesso.');
    }

    /**
     * Exibe uma pergunta específica e suas respostas agrupadas.
     *
     * @param  Pergunta  $pergunta
     * @return \Illuminate\Http\Response
     */
    public function show(Pergunta $pergunta)
    {
        $respostas = $pergunta->respostas()
                            ->selectRaw('resposta, COUNT(*) as qtde')
                            ->groupBy('resposta')
                            ->get();
        return view('pergunta.show', compact('pergunta', 'respostas'));
    }

    /**
     * Mostra o formulário para editar uma pergunta existente.
     *
     * @param  Pergunta  $pergunta
     * @return \Illuminate\Http\Response
     */
    public function edit(Pergunta $pergunta)
    {
        $vagas = Vaga::all();
        return view('pergunta.form', compact('pergunta', 'vagas'));
    }

    /**
     * Atualiza uma pergunta existente no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Pergunta  $pergunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pergunta $pergunta)
    {
        $data = [
            'pergunta'   => $request->input('pergunta'),
            'options'    => ($request->input('text_resp') == True ? null : $request->input('options')),
            'mult_resps' => ($request->input('text_resp') == True ? null : ($request->input('mult_resps') == True)),
        ];

        $pergunta->update($data);

        $pergunta->vagas()->sync($request->input('vagas', []));

        return redirect()
            ->route('pergunta.show', ['pergunta' => $pergunta->id])
            ->with('success', 'Pergunta atualizada com sucesso.');
    }


    /**
     * Remove uma pergunta do banco de dados.
     *
     * @param  int  $pergunta
     * @return \Illuminate\Http\Response
     */
    public function destroy($pergunta)
    {
        $pergunta = Pergunta::find($pergunta);
        $pergunta->delete();

        return redirect()
            ->route('pergunta.index')
            ->with('success', 'Pergunta excluída com sucesso.');
    }
}

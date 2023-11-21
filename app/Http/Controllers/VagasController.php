<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaga;
use Illuminate\Support\Facades\Mail;
use App\Models\Email;

class VagasController extends Controller
{
    public function index()
    {
        $vagas = Vaga::all();

        return view('vagas.index', compact('vagas'));
    }

    public function create()
    {
        // Direcionar para página de criar vaga

        return view('vagas.create');
    }

    public function destroy($id)
    {
        // Lógica para excluir a vaga com o ID fornecido
        $vagas = Vaga::find($id);

        if (!$vagas) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        $vagas->delete();

        return redirect()
            ->route('vaga.index')
            ->with('success', 'Vaga excluída com sucesso.');
    }

    public function edit($id)
    {
        // Lógica para editar o vaga com o ID fornecido
        $vaga = Vaga::find($id);

        if (!$vaga) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        return view('vagas.edit', compact('vaga'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para editar a vaga com o ID fornecido
        $vagas = Vaga::find($id);

        if (!$vagas) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        $vagas->titulo = $request->input('titulo');
        $vagas->unidade = $request->input('unidade');
        $vagas->status = $request->input('status');
        $vagas->save();

        return redirect()
            ->route('vaga.index')
            ->with('success', 'Vaga editada com sucesso.');
    }

    public function store(Request $request)
    {
        view('vagas.index');

        Vaga::create([
            'titulo' => $request->input('titulo'),
            'unidade' => $request->input('unidade'),
            'status' => $request->input('status'),
        ]);
        // Busca o email no banco de dados
        $email = Email::where('template', 'abertura_vaga')->first();
        // decodifica o array de emails
        $destinatarios = json_decode($email->email);
        // Envia o email após a inclusão
        if ($request->input('status') == 'Aberta') {
        Mail::to($destinatarios)->send(new \App\Mail\NovoRegistroEmail($request->input('titulo'), $request->input('unidade'), $request->input('status')));
        
        }

        return redirect()
            ->route('vaga.index')
            ->with('success', 'Vaga adicionada com sucesso.');
    }


 
}
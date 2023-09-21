<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vagas;
use Illuminate\Support\Facades\Mail;

class VagasController extends Controller
{
    public function index()
    {
        $vagas = Vagas::all();

        return view('vagas.index', ['vagas' => $vagas]);
    }

    public function formCreateVagas()
    {
        // Direcionar para página de criar vaga

        return view('vagas.create');
    }

    public function destroy($id)
    {
        // Lógica para excluir a vaga com o ID fornecido
        $vagas = Vagas::find($id);

        if (!$vagas) {
            return redirect()
                ->route('vagas')
                ->with('error', 'Vaga não encontrada.');
        }

        $vagas->delete();

        return redirect()
            ->route('vagas')
            ->with('success', 'Vaga excluída com sucesso.');
    }

    public function formEditVagas($id)
    {
        // Lógica para editar o vaga com o ID fornecido
        $vaga = Vagas::find($id);

        if (!$vaga) {
            return redirect()
                ->route('vagas')
                ->with('error', 'Vaga não encontrada.');
        }

        return view('vagas.edit', compact('vaga'));
    }

    public function editVaga(Request $request, $id)
    {
        // Lógica para editar a vaga com o ID fornecido
        $vagas = Vagas::find($id);

        if (!$vagas) {
            return redirect()
                ->route('vagas')
                ->with('error', 'Vaga não encontrada.');
        }

        $vagas->titulo = $request->input('titulo');
        $vagas->unidade = $request->input('unidade');
        $vagas->status = $request->input('status');
        $vagas->save();

        return redirect()
            ->route('vagas')
            ->with('success', 'Vaga editada com sucesso.');
    }

    public function create(Request $request)
    {
        view('vagas.index');

        Vagas::create([
            'titulo' => $request->input('titulo'),
            'unidade' => $request->input('unidade'),
            'status' => $request->input('status'),
        ]);
        // Agora, envie o email após a inclusão
        if ($request->input('status') == 'Aberta') {
        Mail::to('portalvagass@gmail.com')->send(new \App\Mail\NovoRegistroEmail($request->input('titulo'), $request->input('unidade'), $request->input('status')));
        }

        return redirect()
            ->route('vagas')
            ->with('success', 'Vaga adicionada com sucesso.');
    }
}
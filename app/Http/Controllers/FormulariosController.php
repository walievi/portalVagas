<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\Vaga;

class FormulariosController extends Controller
{
    public function index() {

        $forms = Formulario::all();

        return view('forms.index', ['forms' => $forms]);

    }

    public function formCreateform()
    {
        // Direcionar para página de criar vaga
        $vagas = Vaga::all();


        return view('forms.create', ['vagas' => $vagas]);
    }

    public function destroy($id)
    {
        // Lógica para excluir a vaga com o ID fornecido
        $form = Formulario::find($id);

        if (!$forms) {
            return redirect()
                ->route('forms')
                ->with('error', 'forms não encontrado.');
        }

        $forms->delete();

        return redirect()
            ->route('forms')
            ->with('success', 'Formulário excluída com sucesso.');
    }

    public function formEditForm($id)
    {
        // Lógica para editar o vaga com o ID fornecido
        $form = Formulario::find($id);

        if (!$form) {
            return redirect()
                ->route('forms')
                ->with('error', 'Formulário não encontrado.');
        }

        return view('forms.edit', compact('form'));
    }

    public function editForm(Request $request, $id)
    {
        // Lógica para editar a vaga com o ID fornecido
        $forms = Formulario::find($id);

        if (!$forms) {
            return redirect()
                ->route('forms')
                ->with('error', 'Formulário não encontrado.');
        }

        $forms->nome_formulario = $request->input('nome_formulario');
        $forms->vaga_id = $request->input('vaga_id');
        $forms->save();

        return redirect()
            ->route('forms')
            ->with('success', 'Formulário editado com sucesso.');
    }

    public function create(Request $request)
    {
        view('forms.index');

        Formulario::create([
            'nome_formulario' => $request->input('nome_formulario'),
            'id_vaga' => $request->input('id_vaga'),
        ]);

        return redirect()
            ->route('forms')
            ->with('success', 'Formulário adicionado com sucesso.');
    }

}

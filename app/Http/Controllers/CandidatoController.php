<?php

namespace App\Http\Controllers;

use App\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidato;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\DadosPessoais;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Vaga;
use App\Models\CandidaturaVaga;
use App\Models\Resposta;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidato = Candidato::logged();
        return view('dadosPessoais.index', compact('candidato'));
    }
    /**

     * Display the specified resource.
     *
     * @param  \App\Models\Candidato  $curriculo
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $candidato = Candidato::logged();
        $user = $candidato->user;
        $estados = Estado::get();

        return view('dadosPessoais.form', compact('candidato', 'user', 'estados'));
    }

    /**
     * Atualiza uma pergunta existente no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Pergunta  $pergunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Lógica para editar o usuário com o ID fornecido - user
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('profile')->with('error', 'Usuário não encontrado.');
        }

        // Verifique se já existe um registro de endereço para este usuário
        $endereco = $user->dadosPessoais->endereco ?? new Endereco();
        $endereco->cep = $request->input('cep');
        $endereco->rua = $request->input('rua');
        $endereco->numero = $request->input('numero');
        $endereco->bairro = $request->input('bairro');
        $endereco->estado = $request->input('estado');
        $endereco->cidade = $request->input('cidade');
        $endereco->save();

        // Verifique se já existe um registro de contato para este usuário
        $contato = $user->dadosPessoais->contato ?? new Contato();
        $contato->telefone = $request->input('telefone');
        $contato->celular = $request->input('celular');
        $contato->email = $user->email;
        $contato->save();

        // Crie ou atualize um registro de dados pessoais
        $dadosPessoais = $user->dadosPessoais ?? new DadosPessoais();

        // Preencha os campos dos dados pessoais com base no request
        $dadosPessoais->data_nascimento = $request->input('data_nascimento');
        $dadosPessoais->habilidades = $request->input('habilidades');
        $dadosPessoais->endereco_id = $endereco->id;
        $dadosPessoais->contato_id = $contato->id;

        // Salve os dados pessoais associados a esse usuário
        $user->dadosPessoais()->save($dadosPessoais);

        return redirect()->route('profile')->with('success', 'Dados pessoais editados com sucesso.');
    }

    public function show(){

        $user = auth()->user();
        $vagas = CandidaturaVaga::where('user_id', $user->id)->pluck('vaga_id');
        $vagasCadastradas = Vaga::whereIn('id', $vagas)->get();
        

        return view('users.show', compact('vagasCadastradas'));
    }

    public function cancel($id){

        $user = auth()->user();
        $vagas = CandidaturaVaga::where('user_id', $user->id)->where('vaga_id', $id)->first();

        if($vagas){
            $canditaturaExiste = Resposta::where('user_id', $user->id)->where('vaga_id', $id);
            if($canditaturaExiste->count() > 0){
                $canditaturaExiste->delete(); 
            }
            $vagas->delete();
            return redirect()
            ->route('candidato.show')
            ->with('success', 'Candidatura cancelada com sucesso.');
        }else {
            return redirect()
            ->route('candidato.show')
            ->with('error', 'Candidatura não encontrada.');
        }
    }

}

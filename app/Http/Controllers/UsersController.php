<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\DadosPessoais;
use App\Models\Contato;
use App\Models\Endereco;

class UsersController extends Controller
{
    public function index() {
        $users = User::withTrashed()->get();

        return view('users.users', ['users' => $users]);

    }

    public function destroy($id) {
        // Lógica para excluir o usuário com o ID fornecido
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado.');
        }

        $user->delete();

        return redirect()->route('users')->with('success', 'Usuário desativado com sucesso.');
    }

    public function restore($id)
    {
        // Lógica para excluir o usuário com o ID fornecido
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->restore();

        return redirect()->route('users')->with('success', 'Usuário reativado com sucesso.');
    }

    public function formCreate() {
        // Direcionar para página de criar usuário

        return view('users.create');
    }

     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $dados
     * @return \App\Models\User
     */
    public function create(Request $request) {
        // Lógica para criar o usuário com os dados fornecidos

        view('users.users');

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role') ?? 'user',
        ]);

        return redirect()->route('users')->with('success', 'Usuário adicionado com sucesso.');
    }

    public function formEdit($id) {
        // Lógica para editar o usuário com o ID fornecido
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado.');
        }

        return view('users.edit', compact('user'));
    }

    #função para editar o perfil do usuario
    public function edit(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado.');
        }


        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role') ?? 'user';

        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('users')->with('success', 'Usuário editado com sucesso.');
    }

    public function profile() {
        $user = Auth::user();

        // Carregue os dados pessoais do usuário, juntamente com os relacionamentos de contato e endereço
        $user->load('dadosPessoais', 'dadosPessoais.contato', 'dadosPessoais.endereco');

   

        #retorna os estados para o select
        $estados = Estado::all();

        if ($user->dadosPessoais && $user->dadosPessoais->endereco) {
            $cidade = Cidade::find($user->dadosPessoais->endereco->cidade_id);
        } else {
            $cidade = null;
        }
                #pega o nome da cidade pelo id acima
        return view('users.profile', compact('user', 'estados', 'cidade'));

    }
    
    #função para retornar as cidades de um estado na pagina de perfil do usuario
    public function cidadesPorEstado($estado_id) {
        $cidades = Estado::find($estado_id)->cidades;
        return response()->json($cidades);
    }
    

    public function editProfile(Request $request, $id) {
        // Lógica para editar o usuário com o ID fornecido - user
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado.');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role') ?? 'user';

        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Usuário editado com sucesso.');
    }

    public function editDadosPessoais(Request $request, $id) {
        // Lógica para editar o usuário com o ID fornecido - user
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado.');
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
        $contato->email = $user->email;
        $contato->save();
    
        // Crie ou atualize um registro de dados pessoais
        $dadosPessoais = $user->dadosPessoais ?? new DadosPessoais();
    
        // Preencha os campos dos dados pessoais com base no request
        $dadosPessoais->data_nascimento = $request->input('data_nascimento');
        $dadosPessoais->objetivo_vaga = $request->input('objetivo');
        $dadosPessoais->habilidades = $request->input('habilidades');
        $dadosPessoais->endereco_id = $endereco->id;
        $dadosPessoais->contato_id = $contato->id;
    
        // Salve os dados pessoais associados a esse usuário
        $user->dadosPessoais()->save($dadosPessoais);
    
        return redirect()->route('profile')->with('success', 'Dados pessoais editados com sucesso.');
    }
    

}

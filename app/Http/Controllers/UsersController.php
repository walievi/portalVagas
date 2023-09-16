<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index() {
        #return view('users/users');

        $users = User::all();

        return view('users.users', ['users' => $users]);

    }

    public function destroy($id) {
        // Lógica para excluir o usuário com o ID fornecido
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado.');
        }

        $user->delete();

        return redirect()->route('users')->with('success', 'Usuário excluído com sucesso.');
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
            'role' => $request->input('role'),
        ]);

        return redirect()->route('users')->with('success', 'Usuário adicionado com sucesso.');
    }
    
    // public function listarUsuarios() {
    //     $users = User::all();
    
    //     return view('users.users', ['users' => $users]);
    // }
    
}

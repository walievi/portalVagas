<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function index() {
        #return view('users/users');

        $users = User::all();

        return view('users.users', ['users' => $users]);

    }


    public function destroy($id)
{
    // Lógica para excluir o usuário com o ID fornecido
    $user = User::find($id);
    if (!$user) {
        return redirect()->route('users')->with('error', 'Usuário não encontrado.');
    }

    $user->delete();

    return redirect()->route('users')->with('success', 'Usuário excluído com sucesso.');
}



    
    // public function listarUsuarios()
    // {
    //     $users = User::all();
    
    //     return view('users.users', ['users' => $users]);
    // }
    


}

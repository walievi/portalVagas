<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        return view('users.profile', compact('user'));
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

}

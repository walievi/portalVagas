<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PerfilRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\DadosPessoais;
use App\Models\Contato;
use App\Models\Endereco;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerfilRequest $request)
    {
        $perfil = DB::transaction(function () use ($request) {
            $endereco = Endereco::updateOrCreate(['id' => $request->endereco_id], $request->endereco);

            $perfil = $request->except(['_token', 'endereco']);
            $perfil['endereco_id'] = $endereco->id;
            $perfil = perfil::updateOrCreate(['id' => $request->id], $perfil);

            return $perfil;
        });

        return redirect()->route('perfil.show', ['perfil' => $perfil->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Lógica para editar o usuário com o ID fornecido - user
       $user = User::find($id);

       if (!$user) {
           return redirect()->route('perfil')->with('error', 'Usuário não encontrado.');
       }

       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->role = 'user';

       if ($request->input('password')) {
           $user->password = Hash::make($request->input('password'));
       }

       $user->save();

       return redirect()->route('profile')->with('success', 'Usuário editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

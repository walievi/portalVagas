<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index()
    {
        $produtos = Produto::all();

        return response()->json($produtos);
    }

    public function store(Request $request)
    {
        $produto        = new Produto();
        $produto->nome  = $request->input('nome');
        $produto->preco = $request->input('preco');
        $produto->save();

        return response()->json(['mensagem' => 'Produto cadastrado com sucesso']);
    }


}

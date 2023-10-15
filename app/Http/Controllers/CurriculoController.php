<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculo;

class CurriculoController extends Controller
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
    public function store(Request $request)
    {
        $pdfFile = $request->file('curriculo');
        
        if ($pdfFile) {
            $pdfData = file_get_contents($pdfFile);
    
            $user = auth()->user();
            $curriculo = $user->curriculo; // Obtém o currículo existente do usuário
    
            if (!$curriculo) {
                // Se o usuário não tiver um currículo, crie um novo
                $curriculo = new Curriculo();
                $curriculo->user_id = $user->id;
            }
    
            $curriculo->pdf = $pdfData;
            $curriculo->save();
        }
    
        return redirect()->route('profile')
            ->with('success', 'Currículo enviado com sucesso.');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curriculo = Curriculo::find($id);

        if (!$curriculo) {
            return redirect()->back()->with('error', 'Currículo não encontrado.');
        }
    
        // Obtenha os dados binários do currículo
        $pdfData = $curriculo->pdf;
    
        // Gere um nome de arquivo único
        $filename = 'curriculo_' . $curriculo->user_id . '.pdf';
    
        // Retorne o currículo como uma resposta de arquivo
        return response($pdfData, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
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
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;

class Alunos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::all();

        return view('aluno.index', compact(['alunos']));
    }

    public function store(Request $request)
    {
        $novo = new Aluno();
        $novo->nome = $request->input('nome');
        $novo->email = $request->input('email');
        $novo->curso_id = $request->input('curso_id');
        $novo->save();

        return json_encode($novo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = Aluno::findOrFail($id);
        if(isset($aluno)) {
            return json_encode($aluno);
        }
        return response('Aluno nao encontrado', 404);
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
        $aluno = Aluno::findOrFail($id);
        if(isset($aluno)) {
            $aluno->nome = $request->input('nome');
            $aluno->email = $request->input('email');
            $aluno->curso_id = $request->input('curso_id');
            $aluno->save();

            return json_encode($curso);
        }
        return response('Aluno nao encontrado', 404);
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

<?php

namespace App\Http\Controllers;

use App\Models\resultados;
use Illuminate\Http\Request;

class ResultadosController extends Controller
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
        
        $resultado = new resultados();
        $resultado->tests_id=$request->input('result_test_id');
        $resultado->title=$request->input('title');
        $resultado->description=$request->input('description');
        $resultado->save();

        return response()->json(['message'=>'Registro Guardado'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\resultados  $resultados
     * @return \Illuminate\Http\Response
     */
    public function show(resultados $resultados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\resultados  $resultados
     * @return \Illuminate\Http\Response
     */
    public function edit($resultado_id)
    {
        $resultado = resultados::find($resultado_id);
        return response()->json(['data'=>$resultado], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\resultados  $resultados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   $resultado_id= $request->input('result_id');
        $resultado = resultados::find($resultado_id);
        $resultado->title=$request->input('edit_title');
        $resultado->description=$request->input('edit_description');
        $resultado->save();
        return response()->json(['message'=>'Registro Actualizado'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\resultados  $resultados
     * @return \Illuminate\Http\Response
     */
    public function destroy($resultado_id)
    {
        $resultado = resultados::find($resultado_id);
        $resultado->delete();
        return response()->json(['message'=>'Registro Eliminado'], 200);
    }
}

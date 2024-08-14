<?php

namespace App\Http\Controllers;

use App\Models\tests;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cita_id)
    {
        $pruebas = tests::where('appointments_id',$cita_id)->get();
        return response()->json(['data'=>$pruebas], 200);
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
        $pruebas = new tests();
        $pruebas->appointments_id=$request->input('cita_id');
        $pruebas->tests_name=$request->input('tests_name');
        $pruebas->tests_comments=$request->input('tests_comments');
        $pruebas->save();

        return response()->json(['message'=>'Registro Guardado'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tests  $tests
     * @return \Illuminate\Http\Response
     */
    public function show(tests $tests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tests  $tests
     * @return \Illuminate\Http\Response
     */
    public function edit($tests_id)
    {
        $tests=tests::find($tests_id);
        return response()->json(['data'=>$tests], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tests  $tests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tests $tests)
    {
        $request->input('test_id');
        $tests=tests::find($tests_id);
        $pruebas->tests_name=$request->input('edit_tests_name');
        $pruebas->tests_comments=$request->input('edit_tests_comments');
        $pruebas->save();

        return response()->json(['message'=>'Registro Actualizado'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tests  $tests
     * @return \Illuminate\Http\Response
     */
    public function destroy($tests_id)
    {
        // $existe_datos=

        $tests = tests::find($tests_id);
        $tests->delete();
        return response()->json(['message'=>'Registro Eliminado'], 200);
    }
}

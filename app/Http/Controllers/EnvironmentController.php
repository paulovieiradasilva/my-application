<?php

namespace App\Http\Controllers;

use App\Models\Environment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\EnvironmentCreateRequest;
use App\Http\Requests\EnvironmentUpdateRequest;

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.environments.index')->with('page', 'Ambientes');
    }

    /** */
    public function list()
    {
        return DataTables::of(Environment::select(['id', 'name', 'description', 'created_at', 'updated_at']))
            ->addColumn('action', 'admin.environments._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return $environments = Environment::all();
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
    public function store(EnvironmentCreateRequest $request)
    {
        $environment = Environment::create($request->all());

        return response()->json(['success' => 'Ambiente cadastrado com sucesso!']);
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
        $environment = Environment::find($id);

        return $environment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EnvironmentUpdateRequest $request, $id)
    {
        $environment = Environment::find($id);

        $environment->update($request->all());

        return response()->json(['success' => 'Ambiente atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $environment = Environment::find($id);
        $environment->delete();

        return response()->json(['success' => 'Ambiente deletado com sucesso!']);
    }
}

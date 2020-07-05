<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\TowerCreateRequest;
use App\Http\Requests\TowerUpdateRequest;

class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.towers.index')->with('page', 'Torres');
    }

    /** */
    public function list()
    {
        return DataTables::of(Tower::select(['id', 'name', 'description', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return $towers = Tower::all();
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
    public function store(TowerCreateRequest $request)
    {
        $tower = Tower::create($request->all());

        return response()->json(['success' => 'Torre cadastrada com sucesso!']);
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
        $tower = Tower::find($id);

        return $tower;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TowerUpdateRequest $request, $id)
    {
        $tower = Tower::find($id);

        $tower->update($request->all());

        return response()->json(['success' => 'Torre atualizada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tower = Tower::find($id);
        $tower->delete();

        return response()->json(['success' => 'Torre deletada com sucesso!']);
    }
}

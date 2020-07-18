<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DetailCreateRequest;
use App\Http\Requests\DetailUpdateRequest;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.details.index')->with('page', 'Detalhes');
    }

    /** */
    public function list()
    {
        return DataTables::of(Detail::with(['application', 'environment'])
            ->select(['id', 'application_id', 'type', 'content', 'environment_id', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
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
    public function store(DetailCreateRequest $request)
    {
        try {
            $detail = Detail::create($request->all());

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar detalhe']);
        }

        return response()->json(['success' => 'Detalhe cadastrado com sucesso!']);
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
        $detail = Detail::findOrFail($id);

        return $detail;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DetailUpdateRequest $request, $id)
    {
        try {
            $detail = Detail::findOrFail($id);
            $detail->update($request->all());

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar detalhe']);
        }

        return response()->json(['success' => 'Detalhe atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $detail = Detail::findOrFail($id);
            $detail->delete();

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar detalhe']);
        }

        return response()->json(['success' => 'Detalhe deletado com sucesso!']);
    }
}

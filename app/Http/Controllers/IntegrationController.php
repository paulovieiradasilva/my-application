<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IntegrationCreateRequest;
use App\Http\Requests\IntegrationUpdateRequest;

class IntegrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.integrations.index')->with('page', 'Integrações');
    }

    /** */
    public function list()
    {
        return DataTables::of(Integration::with('application')->select(['id', 'name', 'description', 'type', 'application_id', 'created_at', 'updated_at']))
            ->addColumn('action', 'admin.integrations._actions')
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
    public function store(IntegrationCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $integration = Integration::create($request->all());

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao cadastrar integração']);
        }

        return response()->json(['success' => 'Integração cadastrada com sucesso!']);
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
        $integration = Integration::findOrFail($id);

        return $integration;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IntegrationUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $integration = Integration::findOrFail($id);
            $integration->update($request->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao atualizar integração']);
        }

        return response()->json(['success' => 'Integração atualizada com sucesso!']);
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
            DB::beginTransaction();

            $integration = Integration::findOrFail($id);
            $integration->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao deletar integração']);
        }

        return response()->json(['success' => 'Integração deletada com sucesso!']);
    }
}

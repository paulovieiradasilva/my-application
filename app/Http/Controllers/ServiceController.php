<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\ServiceUpdateRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.services.index')->with('page', 'Serviços');
    }

    /** */
    public function list()
    {
        return DataTables::of(Service::with('application')->select(['id', 'name', 'description', 'start', 'application_id', 'created_at', 'updated_at']))
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
    public function store(ServiceCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $service = Service::create($request->all());

            if ($request->get('username') && $request->get('password')) {
                $service->credential()->create($request->all());
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao cadastrar serviço']);
        }

        return response()->json(['success' => 'Serviço cadastrado com sucesso!']);
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
        $service = Service::with(['credential'])->where('id', $id)->first();

        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $service = Service::findOrFail($id);
            $service->update($request->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao atualizar serviço']);
        }

        return response()->json(['success' => 'Serviço atualizado com sucesso!']);
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

            $service = Service::findOrFail($id);
            $service->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao deletar serviço']);
        }

        return response()->json(['success' => 'Serviço deletado com sucesso!']);
    }
}

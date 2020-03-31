<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ProviderCreateRequest;
use App\Http\Requests\ProviderUpdateRequest;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.providers.index')->with('page', 'Fornecedors');
    }

    /** */
    public function list()
    {
        return DataTables::of(Provider::select(['id', 'name', 'opening_hours', 'on_duty', 'description', 'created_at', 'updated_at']))
            ->addColumn('action', 'admin.providers._actions')
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
    public function store(ProviderCreateRequest $request)
    {
        $provider = Provider::create($request->all());

        return response()->json(['msg' => 'Fornecedor cadastrado com sucesso!']);
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
        $provider = Provider::find($id);

        return $provider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderUpdateRequest $request, $id)
    {
        $provider = Provider::find($id);

        $provider->update($request->all());

        return response()->json(['msg' => 'Fornecedor atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();

        return response()->json(['msg' => 'Fornecedor deletado com sucesso!']);
    }
}

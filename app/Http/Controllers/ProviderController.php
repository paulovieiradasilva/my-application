<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
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
        return view('admin.providers.index')->with('page', 'Fornecedores');
    }

    /** */
    public function list()
    {
        return DataTables::of(Provider::with(['contacts'])
            ->select(['id', 'name', 'opening_hours', 'on_duty', 'description', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return Provider::all();
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
        try {
            Provider::create($request->all());

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar fornecedor']);
        }

        return response()->json(['success' => 'Fornecedor cadastrado com sucesso!']);
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
        $provider->contacts;

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
        try {
            $provider = Provider::find($id);
            $provider->update($request->all());

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar fornecedor']);
        }

        return response()->json(['success' => 'Fornecedor atualizado com sucesso!']);
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
            $provider = Provider::find($id);
            $provider->delete();
            $provider->contacts()->delete();

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar fornecedor']);
        }

        return response()->json(['success' => 'Fornecedor deletado com sucesso!']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use Yajra\DataTables\DataTables;
use Caffeinated\Shinobi\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permissions.index')->with('page', 'Permissões');
    }

    /** */
    public function list()
    {
        return DataTables::of(Permission::select(['id', 'name', 'slug', 'description', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return $permissions = Permission::all();
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
    public function store(PermissionCreateRequest $request)
    {
        Permission::create($request->all());

        return response()->json(['success' => 'Permissão cadastrada com sucesso!']);
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
        return Permission::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        try {
            $permission = Permission::find($id);
            $permission->update($request->all());

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar permissão']);
        }

        return response()->json(['success' => 'Permissão atualizada com sucesso!']);
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
            $permission = Permission::find($id);
            $permission->delete();

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar permissão']);
        }

        return response()->json(['success' => 'Permissão deletada com sucesso!']);
    }
}

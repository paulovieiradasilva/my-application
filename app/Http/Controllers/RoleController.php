<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Caffeinated\Shinobi\Models\Role;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index')->with('page', 'Papéis');
    }

    /** */
    public function list()
    {
        return DataTables::of(Role::select(['id', 'name', 'slug', 'description', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return Role::all();
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
    public function store(RoleCreateRequest $request)
    {
        try {
            $role = Role::create($request->all());
            $role->permissions()->sync($request->get('permissions'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar papél']);
        }

        return response()->json(['success' => 'Papél cadastrado com sucesso!']);
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
        $roles = Role::find($id);
        $roles->permissions;

        return $roles;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        try {
            $role = Role::find($id);
            $role->update($request->all());
            $role->permissions()->sync($request->get('permissions'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar papél']);
        }

        return response()->json(['success' => 'Papél atualizado com sucesso!']);
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
            $role = Role::find($id);
            $role->delete();

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar papél']);
        }

        return response()->json(['success' => 'Papél deletado com sucesso!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('page', 'Usuários');
    }

    /** */
    public function list()
    {
        return DataTables::of(User::with(['roles'])->select(['id', 'name', 'email', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return $users = User::all();
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
    public function store(UserCreateRequest $request)
    {
        try {
            $user = User::create($request->all());
            $user->roles()->sync($request->get('roles'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar usuário']);
        }

        return response()->json(['success' => 'Usuário cadastrado com sucesso!']);
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
        $user = User::find($id);
        $user->roles;

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->update($request->all());
            $user->roles()->sync($request->get('roles'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar usuário']);
        }

        return response()->json(['success' => 'Usuário atualizado com sucesso!']);
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
            $user = User::find($id);
            $user->delete();

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar usuário']);
        }

        return response()->json(['success' => 'Usuário deletado com sucesso!']);
    }
}

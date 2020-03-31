<?php

namespace App\Http\Controllers;

use App\Server;
use App\Environment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ServerCreateRequest;
use App\Http\Requests\ServerUpdateRequest;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.servers.index')->with('page', 'Servidores');
    }

    /** */
    public function list()
    {
        return DataTables::of(Server::with(['environment'])->select(['id', 'name', 'ip', 'os', 'type', 'environment_id', 'description', 'created_at', 'updated_at']))
            ->addColumn('action', 'admin.servers._actions')
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
    public function store(ServerCreateRequest $request)
    {
        $server = Server::create($request->all());

        return response()->json(['msg' => 'Servidor cadastrado com sucesso!']);
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
        $server = Server::find($id);

        return $server;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServerUpdateRequest $request, $id)
    {
        $server = Server::find($id);

        $server->update($request->all());

        return response()->json(['msg' => 'Servidor atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $server = Server::find($id);
        $server->delete();

        return response()->json(['msg' => 'Servidor deletado com sucesso!']);
    }
}

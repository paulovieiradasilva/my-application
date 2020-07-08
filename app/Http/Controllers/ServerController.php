<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Database;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
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
        return DataTables::of(Server::with(['environment'])
            ->select(['id', 'name', 'ip', 'os', 'type', 'environment_id', 'description', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return $servers = Server::all();
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
        try {
            DB::beginTransaction();

            $server = Server::create($request->all());

            if ($request->get('username') && $request->get('password')) {
                $server->credential()->create($request->all());
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao cadastrar servidor']);
        }

        return response()->json(['success' => 'Servidor cadastrado com sucesso!']);
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
        $server = Server::with(['credential', 'databases.credential'])->where('id', $id)->first();

        return ['data' => ['server' => $server]];
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
        try {
            DB::beginTransaction();

            $server = Server::find($id);
            $server->update($request->all());

            if ($request->get('username') && $request->get('password')) {
                $server->credential()->updateOrCreate([], $request->all());
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Erro ao atualizar servidor']);
        }

        return response()->json(['success' => 'Servidor atualizado com sucesso!']);
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

            $server = Server::find($id);
            $server->delete();
            $server->credential()->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Não foi possivel deletar este servidor.']);
        }

        return response()->json(['success' => 'Servidor deletado com sucesso!']);
    }
}

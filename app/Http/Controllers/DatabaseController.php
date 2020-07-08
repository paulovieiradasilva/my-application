<?php

namespace App\Http\Controllers;

use App\Models\Database;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DatabaseCreateRequest;
use App\Http\Requests\DatabaseUpdateRequest;

class DatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.databases.index')->with('page', 'Banco de Dados');
    }

    /** */
    public function list()
    {
        return DataTables::of(Database::with(['server.credential'])
            ->select(['id', 'name', 'sgdb', 'port', 'server_id', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return $databases = Database::all();
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
    public function store(DatabaseCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $database = Database::create($request->all());

            if ($request->get('username') && $request->get('password')) {
                $database->credential()->create($request->all());
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao cadastrar database' . $e]);
        }

        return response()->json(['success' => 'Database cadastrado com sucesso!']);
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
        $databases = Database::with(['credential', 'server'])->where('id', $id)->first();

        return ['data' => ['databases' => $databases]];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DatabaseUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $database = Database::find($id);
            $database->update($request->all());
            $database->credential()->updateOrCreate([], $request->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Erro ao atualizar database' . $e]);
        }

        return response()->json(['success' => 'Database atualizado com sucesso!']);
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

            $database = Database::find($id);
            $database->delete();
            $database->credential()->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao deletar database']);
        }

        return response()->json(['success' => 'Database deletado com sucesso!']);
    }
}

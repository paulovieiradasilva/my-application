<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ApplicationCreateRequest;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.applications.index')->with('page', 'Aplicações');
    }

    /** */
    public function list()
    {
        return DataTables::of(Application::with(['provider'])
            ->select(['id', 'name', 'description', 'start', 'platform', 'type', 'directory_app', 'uri_internet', 'uri_intranet', 'provider_id', 'created_at', 'updated_at']))
            ->addColumn('action', 'admin.applications._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return $applications = Application::all();
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
    public function store(ApplicationCreateRequest $request)
    {
        try {
            $application = Application::create($request->all());

            $application->servers()->attach($request->get('servers'));
            $application->employees()->attach($request->get('employees'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Não foi possivel cadastrar apllicação.']);
        }

        return response()->json(['success' => 'Aplicação cadastrada com sucesso!']);
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
        $application = Application::with(['credential'])->where('id', $id)->first();
        $application->provider;
        $application->servers;
        $application->employees;

        return ['data' => ['application' => $application]];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $application = Application::findOrFail($id);
            $application->update($request->all());

            $application->servers()->sync($request->get('servers'));
            $application->employees()->sync($request->get('employees'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Não foi possivel atualizar apllicação.']);
        }

        return response()->json(['success' => 'Aplicação atualizada com sucesso!']);
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
            $server = Application::findOrFail($id);
            $server->delete();

        } catch (\Exception $e) {
            return response()->json(['error' => 'Não foi possivel deletar apllicação.']);
        }

        return response()->json(['success' => 'Aplicação deletado com sucesso!']);
    }
}

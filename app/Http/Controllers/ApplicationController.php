<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Application;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ApplicationCreateRequest;
use App\Http\Requests\ApplicationUpdateRequest;

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
        return DataTables::of(Application::with(['provider', 'tower'])
            ->select(['id', 'name', 'description', 'start', 'platform', 'type', 'provider_id', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
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
            DB::beginTransaction();

            $application = Application::create($request->all());

            $application->servers()->attach($request->get('servers'));
            $application->employees()->attach($request->get('employees'));

            DB::commit();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Não foi possivel cadastrar aplicação.']);
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
        $application = Application::with([
            'tower',
            'servers.credential',
            'servers.environment',
            'provider.contacts',
            'employees.contacts',
            'integrations.credential',
            'services.credential',
            'details' // corrigir.
        ])->where('id', $id)->get();

        //return $application[0]->servers[0]->credential;
        return view('admin.applications.show', compact('application'))->with('page', 'Aplicações');
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
        $application->details;

        return ['data' => ['application' => $application]];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicationUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $application = Application::findOrFail($id);

            $application->update($request->all());
            $application->servers()->sync($request->get('servers'));
            $application->employees()->sync($request->get('employees'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
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

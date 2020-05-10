<?php

namespace App\Http\Controllers;

use App\Models\Detail;
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
        return DataTables::of(Application::with(['provider','tower'])
            ->select(['id', 'name', 'description', 'start', 'platform', 'type', 'provider_id', 'created_at', 'updated_at']))
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
            DB::beginTransaction();

            $application = Application::create($request->all());

            $application->servers()->attach($request->get('servers'));
            $application->employees()->attach($request->get('employees'));

            /** Details */
            $environments = $request->get('environments');
            $locations = $request->get('locations');
            $contents = $request->get('contents');

            /** Depois do PHP 7.2.X */
            $pkCount = (is_array($environments) ? count($environments) : 0);

            /** */
            $i = 0;

            while ($i < $pkCount) {

                $envs = DB::table('environments')->where('name', $environments[$i])->first();

                /** */
                $details = new Detail();
                $details->application_id = $application->id;
                $details->environment_id = $envs->id;
                $details->type = $locations[$i];
                $details->content = $contents[$i];
                $details->save();

                $i++;
            }

            DB::commit();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Não foi possivel cadastrar apllicação.', $e]);
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

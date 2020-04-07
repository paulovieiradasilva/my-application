<?php

namespace App\Http\Controllers;

use App\Tower;
use App\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Events\ClearNullContacts;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employees.index')->with('page', 'Funcionarios');
    }

    /** */
    public function list()
    {
        return DataTables::of(Employee::with(['tower', 'contacts'])->select(['id', 'name', 'type', 'tower_id', 'created_at', 'updated_at']))
            ->addColumn('action', 'admin.employees._actions')
            ->make(true);
    }

    /** */
    public function get()
    {
        return $towers = Tower::all();
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
    public function store(EmployeeCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $employee = Employee::create($request->all());
            $employee->contacts()->create($request->all());

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao cadastrar funcionario']);
        }

        return response()->json(['success' => 'Funcionario cadastrado com sucesso!']);
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
        $employee = Employee::find($id);
        $employee->contacts;

        return $employee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $employee = Employee::find($id);
            $employee->update($request->all());
            $employee->contacts()->updateOrCreate([], $request->all());
            event(new ClearNullContacts($employee->id));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao atualizar funcionario']);
        }

        return response()->json(['success' => 'Funcionario atualizado com sucesso!']);
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

            $employee = Employee::find($id);
            $employee->delete();
            $employee->contacts()->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao deletar funcionario']);
        }

        return response()->json(['success' => 'Funcionario deletado com sucesso!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Tower;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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
        return DataTables::of(Employee::with(['tower'])->select(['id', 'name', 'type', 'tower_id', 'created_at', 'updated_at']))
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
        $employee = Employee::create($request->all());

        return response()->json(['msg' => 'Funcionario cadastrado com sucesso!']);
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
        $employee = Employee::find($id);

        $employee->update($request->all());

        return response()->json(['msg' => 'Funcionario atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json(['msg' => 'Funcionario deletado com sucesso!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contacts.index')->with('page', 'Contatos');
    }

    /** */
    public function list()
    {
        return DataTables::of(Contact::query()
            ->select(['id', 'email', 'phone', 'cellphone', 'site', 'contactable_type', 'contactable_id', 'created_at', 'updated_at']))
            ->addColumn('action', 'components.button._actions')
            ->make(true);
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
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            Contact::create($request->all());
            return response()->json(['success' => 'Contato cadastrado com sucesso!']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar contato']);
        }
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
        $contact = Contact::findOrFail($id);

        return $contact;
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
        // dd($request->all());
        try {
            DB::beginTransaction();

            $contact = Contact::findOrFail($id);
            $contact->update($request->all());

            DB::commit();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar contato']);
        }

        return response()->json(['success' => 'Contato atualizar com sucesso!']);
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
            $contact = Contact::findOrFail($id);
            $contact->delete();

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar contato']);
        }

        return response()->json(['success' => 'Contato deletado com sucesso!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Departemen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departemens = Departemen::all();
        return view('departemens.index');
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
        $this->validate($request, [
            'nama_departemen'      => 'required',
        ]);

        Departemen::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Departemen Created'
        ]);

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
        $departemen = Departemen::find($id);
        return $departemen;
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
        $this->validate($request, [
            'nama_departemen'      => 'required|string|min:2',
        ]);

        $departemen = Departemen::findOrFail($id);

        $departemen->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Departemen Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Departemen::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Departemen Delete'
        ]);
    }

    public function apiDepartemens()
    {
        $departemen = Departemen::orderBy('id', 'desc')->get();

        return Datatables::of($departemen)
        ->addIndexColumn()
            ->addColumn('action', function($departemen){
                return '<a onclick="editForm('. $departemen->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $departemen->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

}

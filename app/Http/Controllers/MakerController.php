<?php

namespace App\Http\Controllers;

use App\Maker;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MakerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff,manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('makers.index');
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
            'nama_maker'      => 'required',
        ]);

        Maker::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Maker Created'
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
        $maker = Maker::find($id);
        return $maker;
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
            'nama_maker'      => 'required|string|min:2',
        ]);

        $maker = Maker::findOrFail($id);

        $maker->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Maker Updated'
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
        Maker::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Maker Delete'
        ]);
    }

    public function apiMakers()
    {
        $maker = Maker::orderBy('id', 'desc')->get();

        return Datatables::of($maker)
        ->addIndexColumn()
            ->addColumn('action', function($maker){
                return '<a onclick="editForm('. $maker->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $maker->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }
}

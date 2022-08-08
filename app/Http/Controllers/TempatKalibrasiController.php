<?php

namespace App\Http\Controllers;

use App\TempatKalibrasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TempatKalibrasiController extends Controller
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
        $tempat_kalibrasis = TempatKalibrasi::all();
        return view('tempat_kalibrasis.index');
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
            'tempat_kalibrasi'      => 'required',
            'alamat'      => '',
        ]);
        TempatKalibrasi::create($request->all());
        return response()->json([
            'success'    => true,
            'message'    => 'Tempat Kalibrasi Created'
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
        $tempat_kalibrasi = TempatKalibrasi::find($id);
        return $tempat_kalibrasi;
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
            'tempat_kalibrasi'      => 'required|string|min:2',
            'alamat'      => '',
        ]);

        $tempat_kalibrasi = TempatKalibrasi::findOrFail($id);

        $tempat_kalibrasi->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Tempat Kalibrasi Updated'
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
        TempatKalibrasi::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Tempat Kalibrasi Delete'
        ]);
    }

    public function apiTempatKalibrasis()
    {
        $tempat_kalibrasi = TempatKalibrasi::orderBy('id', 'desc')->get();

        return Datatables::of($tempat_kalibrasi)
            ->addIndexColumn()
            ->addColumn('action', function($tempat_kalibrasi){
                return '<a onclick="editForm('. $tempat_kalibrasi->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $tempat_kalibrasi->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\LokasiAlatukur;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LokasiAlatukurController extends Controller
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
        $lokasi_alatukurs = LokasiAlatukur::all();
        return view('lokasi_alatukurs.index');
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
            'lokasi_alatukur'      => 'required',
        ]);

        LokasiAlatukur::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Lokasi Alat Ukur Created'
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
        $lokasi_alatukur = LokasiAlatukur::find($id);
        return $lokasi_alatukur;
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
            'lokasi_alatukur'      => 'required|string|min:2',
        ]);

        $lokasi_alatukur = LokasiAlatukur::findOrFail($id);

        $lokasi_alatukur->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Lokasi Alat Ukur Updated'
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
        LokasiAlatukur::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Lokasi Alat Ukur Delete'
        ]);
    }

    public function apiLokasiAlatukurs()
    {
        $lokasi_alatukur = LokasiAlatukur::all();

        return Datatables::of($lokasi_alatukur)
        ->addIndexColumn()
            ->addColumn('action', function($lokasi_alatukur){
                return '<a onclick="editForm('. $lokasi_alatukur->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $lokasi_alatukur->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }
}

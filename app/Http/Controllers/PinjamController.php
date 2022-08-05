<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\Alatukur;
use App\Pinjam;
use App\Exports\ExportPinjams;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;

class PinjamController extends Controller
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
        $alatukur = Alatukur::all();

        $departemen = Departemen::orderBy('nama_departemen','ASC')
            ->get()
            ->pluck('nama_departemen','id');

        $pinjam = Pinjam::all();
        return view('pinjams.index', compact('alatukur', 'departemen'));
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
        $alatukur = Alatukur::all();

        $departemen = Departemen::orderBy('nama_departemen','ASC')
            ->get()
            ->pluck('nama_departemen','id');

        $this->validate($request , [
            'nama_peminjam'     => 'required|string',
            'alatukur_id'      => 'required',
            'tgl_pinjam'      => 'required',
            'tgl_kembali'    => 'required',
            'departemen_id' => 'required',
        ]);

        $input = $request->all();
        Pinjam::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Pinjam Created'
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
        $alatukur = Alatukur::all();

        $departemen = Departemen::orderBy('nama_departemen','ASC')
            ->get()
            ->pluck('nama_departemen','id');

        $pinjam = Pinjam::find($id);
        return $pinjam;
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
        $alatukur = Alatukur::all();

        $departemen = Departemen::orderBy('nama_departemen','ASC')
            ->get()
            ->pluck('nama_departemen','id');

        $this->validate($request , [
            'nama_peminjam'     => 'required|string',
            'alatukur_id'      => 'required',
            'tgl_pinjam'      => 'required',
            'tgl_kembali'    => 'required',
            'departemen_id' => 'required',
        ]);

        $pinjams = Pinjam::findOrFail($id);

        $pinjams->update($request);

        return response()->json([
            'success' => true,
            'message' => 'Pinjam Update'
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
        Pinjam::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Pinjam Deleted'
        ]);
    }

    public function apiPinjams(){
        $pinjam = Pinjam::all();

        return Datatables::of($pinjam)
            ->addIndexColumn()
            ->addColumn('nama_alat', function ($pinjam){
                return $pinjam->alatukur->nama_alat;
            })
            ->addColumn('no_seri', function ($pinjam){
                return $pinjam->alatukur->no_seri;
            })
            ->addColumn('nama_departemen', function ($pinjam){
                return $pinjam->departemen->nama_departemen;
            })
            ->addColumn('action', function($pinjam){
                return // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $pinjam->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $pinjam->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['nama_alat', 'no_seri', 'nama_departemen','action'])->make(true);

    }

    public function exportPinjamsAll()
    {
        $pinjams = Pinjam::all();
        $pdf = PDF::loadView('pinjams.PinjamsAllPDF',compact('pinjams'));
        return $pdf->download('pinjams.pdf');
    }

    public function exportExcel()
    {
        return (new ExportPinjams)->download('pinjams.xlsx');
    }
}

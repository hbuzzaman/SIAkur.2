<?php

namespace App\Http\Controllers;

use App\Alatukur;
use App\CekFisik;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CekFisikController extends Controller
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

        $cek_fisiks = CekFisik::all();
        return view('cek_fisiks.index', compact('alatukur'));
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

        $this->validate($request , [
            'alatukur_id'      => 'required',
            'check1'      => '',
            'check2'      => '',
            'check3'      => '',
            'check4'      => '',
            'check5'      => '',
            'judge'    => 'required',
            'keterangan'    => '',
        ]);

        $input = $request->all();
        CekFisik::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Cek Fisik Created'
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

        $cek_fisik = CekFisik::find($id);
        return $cek_fisik;
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

        $this->validate($request , [
            'alatukur_id'      => 'required',
            'check1'      => '',
            'check2'      => '',
            'check3'      => '',
            'check4'      => '',
            'check5'      => '',
            'judge'    => 'required',
            'keterangan'    => '',
        ]);

        $cek_fisik = CekFisik::findOrFail($id);

        $cek_fisik->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cek Fisik Update'
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
        CekFisik::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Cek Fisik Deleted'
        ]);
    }

    public function apiCekFisiks()
    {
        $cek_fisiks = CekFisik::all();

        return Datatables::of($cek_fisiks)
        ->addIndexColumn()
            ->addColumn('nama_alat', function ($cek_fisiks){
                return $cek_fisiks->alatukur->nama_alat;
            })
            ->addColumn('pic_id', function ($cek_fisiks){
                return $cek_fisiks->alatukur->pic->nama_pic;
            })
            ->addColumn('satu', function ($cek_fisiks){
                if (!$cek_fisiks->check1 == null){
                    return
                    " &radic;";
                }
                return '';
            })
            ->addColumn('dua', function ($cek_fisiks){
                if (!$cek_fisiks->check2 == null){
                    return
                    " &radic;";
                }
                return '';
            })
            ->addColumn('tiga', function ($cek_fisiks){
                if (!$cek_fisiks->check3 == null){
                    return
                    " &radic;";
                }
                return '';
            })
            ->addColumn('empat', function ($cek_fisiks){
                if (!$cek_fisiks->check4 == null){
                    return
                    " &radic;";
                }
                return '';
            })
            ->addColumn('lima', function ($cek_fisiks){
                if (!$cek_fisiks->check5 == null){
                    return
                    " &radic;";
                }
                return '';
            })
            ->addColumn('satu', function ($cek_fisiks){
                if (!$cek_fisiks->check1 == null){
                    return
                    " &radic;";
                }
                return '';
            })
            ->addColumn('action', function($cek_fisiks){
                return // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $cek_fisiks->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $cek_fisiks->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['nama_alat', 'pic_id', 'satu', 'dua', 'tiga', 'empat', 'lima', 'action'])->make(true);

    }
}

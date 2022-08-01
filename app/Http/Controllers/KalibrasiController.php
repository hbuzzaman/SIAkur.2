<?php

namespace App\Http\Controllers;

use App\Kalibrasi;
use App\Alatukur;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KalibrasiController extends Controller
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

        $kalibrasi = Kalibrasi::all();
        return view('kalibrasis.index', compact('alatukur'));
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
            'alatukur_id'       => 'required',
            'tgl_kalibrasi'     => 'required',
            'tgl_nextkalibrasi' => '',
            'tgl_sertifikat'    => '',
            'status'            => '',
        ]);

        $input = $request->all();

        if($request->file('sertifikat')){
            $input['sertifikat']=$request->file('sertifikat')->store('kalibrasi');
        }

        Kalibrasi::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat Kalibrasi Created'
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

        $kalibrasi = Kalibrasi::find($id);
        return $kalibrasi;
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

            $this->validate($request, [
                'alatukur_id'       => 'required',
                'tgl_kalibrasi'     => 'required',
                'tgl_nextkalibrasi' => '',
                'tgl_sertifikat'    => '',
                //'sertifikat'      => '',
                'status'            => '',
            ]);

            $kalibrasii = Kalibrasi::findOrFail($id);
    
            $input['sertifikat'] = $kalibrasii->sertifikat;
    
            if ($request->hasFile('sertifikat')){
                if (!$kalibrasii->sertifikat == NULL){
                    unlink(public_path($kalibrasii->sertifikat));
                }
                $fileName = $request->file('sertifikat')->getClientOriginalName();
                $input['sertifikat'] = '/upload/sertifikats/'.str_slug($fileName,'-').'.'.$request->sertifikat->getClientOriginalExtension();
                $request->sertifikat->move(public_path('/upload/sertifikats/'), $input['sertifikat']);
            }
    
            $kalibrasii->update($input);
    
            return response()->json([
                'success'    => true,
                'message'    => 'Riwayat Kalibrasi Updated'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kalibrasi $kalibrasi)
    {
        Kalibrasi::destroy($kalibrasi->id);
        return response()->json([
            'success' => true,
            'message' => 'Riwayat Kalibrasi Deleted'
        ]);
    }

    public function apiKalibrasis(){
        // $kalibrasi = Kalibrasi::all();
        $kalibrasi = Kalibrasi::orderBy('id', 'desc')->get();


        return Datatables::of($kalibrasi)
        ->addIndexColumn()
        ->addColumn('nama_alat', function ($kalibrasi){
            return $kalibrasi->alatukur->nama_alat;
         })
        ->addColumn('show_photo', function($kalibrasi){
            $url=asset('storage/'.$kalibrasi->sertifikat);
        if ($kalibrasi->sertifikat == NULL){
            return 'No Image';
        }
        return '<img class="rounded-square" width="50" height="50" src="'. $url .'" alt="">';
        })
        ->addColumn('action', function($kalibrasi){
            return 
            // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                '<a onclick="editForm('. $kalibrasi->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                '<a onclick="deleteData('. $kalibrasi->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })
        ->rawColumns(['nama_alat','show_photo','action'])->make(true);
}
}

<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
            'sertifikat'        => 'mimes:jpg,jpeg,png|max:2000',
            'status'            => '',
        ]);

        $input = $request->all();

        if($request->file('sertifikat')){
            $s = Str::slug($request['tgl_kalibrasi'], '-').'.'.$request->sertifikat->getClientOriginalExtension();
            $input['sertifikat']=$request->file('sertifikat')->storeAs('kalibrasis', $s);
        }
        // if($request->file('sertifikat')){
        //     $input['sertifikat']=$request->file('sertifikat')->store('kalibrasi');
        // }

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
    public function update(Request $request, Kalibrasi $kalibrasi)
    {
            $this->validate($request, [
                'alatukur_id'       => 'required',
                'tgl_kalibrasi'     => 'required',
                'tgl_nextkalibrasi' => '',
                'tgl_sertifikat'    => '',
                //'sertifikat'      => '',
                'status'            => '',
            ]);

            $input = $request->all();

        if ($request->hasFile('sertifikat')){
            // jika ada fotonya, hapus
            if (!$kalibrasi->sertifikat == NULL){
                     $image_path = "storage/".$kalibrasi->sertifikat;
                    File::delete($image_path);
            }
            // lalu insert foto baru dan jika foto tidak ada
                $s =  Str::slug($request['tgl_kalibrasi'], '-').'.'.$request->sertifikat->getClientOriginalExtension();
                $input['sertifikat']=$request->file('sertifikat')->storeAs('kalibrasis', $s);
        }

        $kalibrasi->update($input);
    
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
        $image_path = "storage/".$kalibrasi->sertifikat;

        if (file_exists($image_path)){
            File::delete($image_path);
        }

        Kalibrasi::destroy($kalibrasi->id);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat Kalibrasi Deleted'
        ]);
    }

    public function apiKalibrasis(){
        $kalibrasi = Kalibrasi::orderBy('id', 'desc')->get();

        return Datatables::of($kalibrasi)
        ->addIndexColumn()
        ->addColumn('nama_alat', function ($kalibrasi){
            return $kalibrasi->alatukur->nama_alat;
         })
        ->addColumn('show_photo', function($kalibrasi){
        if ($kalibrasi->sertifikat == NULL){
            return 'No Image';
        }
        $url = asset('storage/'.$kalibrasi->sertifikat);
        return '<img class="rounded-square" width="50" height="50" src="'. $url .'" alt="">';
        })
        ->addColumn('action', function($kalibrasi){
            if (Auth::user()->role == 'manager'){
                return
                '<a onclick="banned()" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                '<a onclick="banned()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            }
            return
            '<a onclick="editForm('. $kalibrasi->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
            '<a onclick="deleteData('. $kalibrasi->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
        })
        ->rawColumns(['nama_alat','show_photo','action'])->make(true);
}
}

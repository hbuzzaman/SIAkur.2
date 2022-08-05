<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Departemen;
use App\Maker;
use App\Alatukur;
use App\LokasiAlatukur;
use App\Kalibrasi;
use App\Pic;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AlatukurController extends Controller
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
        $maker = Maker::orderBy('nama_maker','ASC')
            ->get()
            ->pluck('nama_maker','id');

        $departemen = Departemen::orderBy('nama_departemen','ASC')
            ->get()
            ->pluck('nama_departemen','id');

        $lokasi_alatukur = LokasiAlatukur::orderBy('lokasi_alatukur','ASC')
            ->get()
            ->pluck('lokasi_alatukur','id');

        $pic = Pic::all();

        $alatukurz = Alatukur::all();
        return view('alatukurs.index', compact('departemen','maker', 'lokasi_alatukur', 'pic'));
    }

    public function rusak()
    {   
        $alatukurz = Alatukur::where('kondisi', '=', 'Rusak')->get();
        
        return view('alatukurs.rusak',[
            "rusak" => $alatukurz
        ]);
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

        $this->validate($request , [
            'nama_alat'          => 'required|string',
            'no_seri'            => 'required',
            'no_reg'             => 'required',
            'range'              => 'required',
            'resolusi'           => 'required',
            'maker_id'           => 'required',
            'tgl_plan'           => 'required',
            'tgl_actual'         => '',
            'departemen_id'      => 'required',
            'lokasi_alatukur_id' => 'required',
            'frekuensi'          => 'required',
            'gambar'             => 'mimes:jpg,jpeg,png|max:2000',
            'pic_id'             => 'required'
            // 'sertifikat'         => '',
        ]);

        $input = $request->all();

        if($request->file('gambar')){
            $g = Str::slug($request['nama_alat'], '-').'.'.$request->gambar->getClientOriginalExtension();
            $input['gambar']=$request->file('gambar')->storeAs('alatukurs', $g);
        }

        Alatukur::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Alat Ukur Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Alatukur $alatukur)
    {
        $kalibrasi = Kalibrasi::latest()
        ->where('alatukur_id', '=', $alatukur->id)
                ->limit(1)
                ->get();
        $riwayat = Kalibrasi::where('alatukur_id', '=', $alatukur->id)->count();
        $kalibrasis = Kalibrasi::where('alatukur_id', '=', $alatukur->id)->get();

        // $new = $alatukur->created_at;
        $shownew = Carbon::now()->subDays(5);

        return view('alatukurs.detail',  [
            'akur' => $alatukur,
            'kb' =>  $kalibrasi,
            'count' => $riwayat,
            'new' => $shownew,
            'kalibrasis' => $kalibrasis,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alatukur = Alatukur::find($id);
        return $alatukur;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alatukur $alatukur)
    {

        $this->validate($request , [
            'nama_alat'          => 'required|string',
            'no_seri'            => 'required',
            'no_reg'             => 'required',
            'range'              => 'required',
            'resolusi'           => 'required',
            'maker_id'           => 'required',
            'tgl_plan'           => 'required',
            'tgl_actual'         => '',
            'departemen_id'      => 'required',
            'lokasi_alatukur_id' => 'required',
            'frekuensi'          => 'required',
            'gambar'             => '',
            //'sertifikat'       => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('gambar')){
            // jika ada fotonya, hapus
            if (!$alatukur->gambar == NULL){
                     $image_path = "storage/".$alatukur->gambar;
                    File::delete($image_path);
            }
            // lalu insert foto baru dan jika foto tidak ada
                $g =  Str::slug($request['nama_alat'], '-').'.'.$request->gambar->getClientOriginalExtension();
                $input['gambar']=$request->file('gambar')->storeAs('alatukurs', $g);
        }

        $alatukur->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Alat Ukur Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alatukur $alatukur)
    {
        $image_path = "storage/".$alatukur->gambar;
        // dd($image_path);

        if (file_exists($image_path)){
            File::delete($image_path);
        }

        Alatukur::destroy($alatukur->id);

        return response()->json([
            'success' => true,
            'message' => 'Alat Ukur Deleted'
        ]);
    }

    public function apiAlatukurs(){
        $alatukurz = Alatukur::orderBy('id', 'desc')
            ->where('kondisi', '=', 'OK')->get();

        return Datatables::of($alatukurz)
        ->addIndexColumn()
            ->addColumn('nama_maker', function ($alatukurz){
                return $alatukurz->maker->nama_maker;
            })
            ->addColumn('nama_departemen', function ($alatukurz){
                return $alatukurz->departemen->nama_departemen;
            })
            ->addColumn('lokasi_alatukur', function ($alatukurz){
                return $alatukurz->lokasi_alatukur->lokasi_alatukur;
            })
            ->addColumn('show_photo', function($alatukurz){
                if ($alatukurz->gambar == NULL){
                    return 'No Image';
                }
                $url = asset('storage/'.$alatukurz->gambar);
                return '<img class="rounded-square" width="50" height="50" src="'. $url .'" alt="">';
                })
            // ->addColumn('show_sertifikat', function($alatukurz){
            //     if ($alatukurz->sertifikat == NULL){
            //         return 'No Image';
            //     }
            //     return '<img class="rounded-square" width="50" height="50" src="'. url($alatukurz->sertifikat) .'" alt="">';
            // })
            ->addColumn('new', function($alatukurz){
                $shownew = Carbon::now()->subDays(5);
                if ($shownew <= $alatukurz->created_at){
                    return '<span class="label label-success">NEW</span>';
                }
                return '<span class="label label-primary">OLD</span>';
                })

            ->addColumn('action', function($alatukurz){
                if (Auth::user()->role == 'manager'){
                    return
                    '<a onclick="banned()" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="banned()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                }
                return
                '<a href="alatukurs/'. $alatukurz->id .'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                '<a onclick="editForm('. $alatukurz->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                '<a onclick="deleteData('. $alatukurz->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            })
            ->rawColumns(['nama_maker', 'nama_departemen', 'lokasi_alatukur', 'show_photo','new', 'action'])->make(true);
    }
    
}

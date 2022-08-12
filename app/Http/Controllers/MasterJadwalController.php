<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\MasterJadwal;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MasterJadwalController extends Controller
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
        $masterjadwal = MasterJadwal::all();
        return view('master_jadwals.index');
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
            'picture'          => 'mimes:jpg,jpeg,png|max:2000',
        ]);

        $input = $request->all();
        
        if($request->file('picture')){
            $p =  Str::slug($request['picture'], '-').'.'.$request->picture->getClientOriginalExtension();
            $input['picture']=$request->file('picture')->storeAs('masterjadwals', $p);
        }

        MasterJadwal::create($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Master Jadwal Created'
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

    public function masterjadwal()
    {
        $masterjadwal = MasterJadwal::latest()
                ->limit(1)
                ->get();
        // dd($masterjadwal);
        return view('master_jadwals.detail',  [
            'mj' => $masterjadwal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masterjadwal = MasterJadwal::find($id);
        return $masterjadwal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJadwal $master_jadwal)
    {

        $this->validate($request, [
            'picture'        => '',
        ]);
        
        $input = $request->all();

        if ($request->hasFile('picture')){
            //jika fotonya ada, hapus
            if (!$master_jadwal->picture == NULL){
                $image_path = "storage/".$master_jadwal->picture;
                File::delete($image_path);
            }
            //lalu insert foto baru dan jika foto tidak ada
            $p = Str::slug($request['picture'], '-').'.'.$request->picture->getClientOriginalExtension();
            $input['picture']=$request->file('picture')->storeAs('masterjadwals', $p);
        }

        $master_jadwal->update($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Master Jadwal Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJadwal $master_jadwal)
    {
        $image_path = "storage/".$master_jadwal->picture;
        // dd($image_path);

        if (file_exists($image_path)){
            File::delete($image_path);
        }
        
        MasterJadwal::destroy($master_jadwal->id);

        return response()->json([
            'success'    => true,
            'message'    => 'Master Jadwal Delete'
        ]);
    }

    public function apiMasterJadwals(){
        $masterjadwal = MasterJadwal::orderBy('id', 'desc')->get();

        return Datatables::of($masterjadwal)
            ->addIndexColumn()
            ->addColumn('show_photo', function($masterjadwal){
            if ($masterjadwal->picture == NULL){
                return 'No Image';
            }
            $url = asset('storage/'.$masterjadwal->picture);
            return '<img class="rounded-square" width="50" height="50" src="'. $url .'" alt="">';
            })
            ->addColumn('action', function($masterjadwal){
                if (Auth::user()->role == 'manager'){
                    return
                    '<a onclick="banned()" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="banned()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                }
                return
                '<a onclick="editForm('. $masterjadwal->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                '<a onclick="deleteData('. $masterjadwal->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            })
            ->rawColumns(['show_photo','action'])->make(true);
    }
}

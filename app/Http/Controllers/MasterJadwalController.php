<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\MasterJadwal;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MasterJadwalController extends Controller
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

        // if ($request->hasFile('sertifikat')){
        //     $input['sertifikat'] = '/upload/sertifikat/'.str_slug($input['nama_alat'], '-').'.'.$request->sertifikat->getClientOriginalExtension();
        //     $request->sertifikat->move(public_path('/upload/sertifikat/'), $input['sertifikat']);
        // }

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
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            //'foto'        => 'required',
        ]);
        
        $input = $request->all();
        $masterj = MasterJadwal::findOrFail($id);

        $input['picture'] = $masterj->picture;

        if ($request->hasFile('picture')){
            if (!$masterj->picture == NULL){
                unlink(public_path($masterj->picture));
            }
            $input['picture'] = '/upload/masterjadwals/'.str_slug($input['picture'], '-').'.'.$request->picture->getClientOriginalExtension();
            $request->picture->move(public_path('/upload/masterjadwals/'), $input['picture']);
        }

        $masterj->update($input);

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
    public function destroy(MasterJadwal $masterjadwal)
    {
        // $pic = Pic::findOrFail($id);

        $image_path = "storage/".$masterjadwal->picture;
        // dd($image_path);

        if (file_exists($image_path)){
            // Storage::delete('public/pics/'.$pic->foto);
            File::delete($image_path);
        }
        
        MasterJadwal::destroy($masterjadwal->id);

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
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a>'
                    '<a onclick="editForm('. $masterjadwal->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $masterjadwal->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['show_photo','action'])->make(true);
    }
}

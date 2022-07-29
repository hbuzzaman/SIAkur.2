<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use App\Pic;
use App\Departemen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PicController extends Controller
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
        $departemen = Departemen::orderBy('nama_departemen','ASC')
            ->get()
            ->pluck('nama_departemen','id');

        $pic = Pic::all();
        return view('pics.index', compact('departemen'));
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
            'idkaryawan'    => 'required|string',
            'nama_pic'      => 'required',
            'departemen_id' => 'required',
            'foto'          => 'mimes:jpg,jpeg,png|max:2000',
        ]);

        $input = $request->all();

        if($request->file('foto')){
            $input['foto']=$request->file('foto')->store('pics');
        }

        Pic::create($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Pic Created'
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
        $pic = Pic::find($id);
        return $pic;
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
            'idkaryawan'    => 'required|string',
            'nama_pic'      => 'required',
            'departemen_id' => 'required',
            //'foto'        => 'required',
        ]);
        
        $input = $request->all();
        $picc = Pic::findOrFail($id);

        $input['foto'] = $picc->foto;

        if ($request->hasFile('foto')){
            if (!$picc->foto == NULL){
                unlink(public_path($picc->foto));
            }
            $input['foto'] = '/upload/pics/'.str_slug($input['nama_pic'], '-').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/pics/'), $input['foto']);
        }

        $picc->update($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Pic Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pic $pic)
    {
        // $pic = Pic::findOrFail($id);

        $image_path = "storage/".$pic->foto;
        // dd($image_path);

        if (file_exists($image_path)){
            // Storage::delete('public/pics/'.$pic->foto);
            File::delete($image_path);
        }
        
        Pic::destroy($pic->id);

        return response()->json([
            'success'    => true,
            'message'    => 'Pic Delete'
        ]);
    }

    public function apiPics(){
        $pic = Pic::orderBy('id', 'desc')->get();

        return Datatables::of($pic)
            ->addIndexColumn()
            ->addColumn('nama_departemen', function ($pic){
                return $pic->departemen->nama_departemen;
             })
            ->addColumn('show_photo', function($pic){
            if ($pic->foto == NULL){
                return 'No Image';
            }
            $foto = asset('storage/'.$pic->foto);
            return '<img class="rounded-square" width="50" height="50" src="'. $foto .'" alt="">';
            })
            ->addColumn('action', function($pic){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a>'
                    '<a onclick="editForm('. $pic->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $pic->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['nama_departemen','show_photo','action'])->make(true);
    }

}

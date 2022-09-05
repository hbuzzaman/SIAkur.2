<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Alatukur;
use App\Kalibrasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new contro
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kalibrasi = Kalibrasi::orderByDesc('tgl_nextkalibrasi')->get()->unique('alatukur_id');
        // $kalibrasi = Kalibrasi::groupBy('alatukur_id','desc')->get();
        $alatukurz = Alatukur::where('kondisi', 'Rusak')->count();
        $min1m = Carbon::now()->addDays(5);
        return view('home',[
            "count" => $alatukurz,
            "kalibrasis" => $kalibrasi,
            "m" => $min1m,
        ]);
    }
}

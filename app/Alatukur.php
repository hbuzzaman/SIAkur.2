<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alatukur extends Model
{
    // protected $fillable = ['nama_alat', 'no_seri', 'no_reg', 'range', 'resolusi', 'maker_id', 'tgl_plan', 'tgl_actual', 'departemen_id', 'lokasi_alatukur_id','frekuensi', 'gambar'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function lokasi_alatukur()
    {
        return $this->belongsTo(LokasiAlatukur::class);
    }

    public function kalibrasi()
    {
        return $this->hasMany(Kalibrasi::class);
    }

    public function pinjam()
    {
        return $this->hasMany(Pinjam::class);
    }

    public function pic()
    {
        return $this->belongsTo(Pic::class);
    }
}

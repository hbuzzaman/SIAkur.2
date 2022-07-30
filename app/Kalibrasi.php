<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kalibrasi extends Model
{
    // protected $fillable = ['alatukur_id', 'tgl_kalibrasi', 'tgl_nextkalibrasi', 'tgl_sertifikat', 'sertifikat', 'status'];
    protected $guarded =['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function alatukur()
    {
        return $this->belongsTo(Alatukur::class);
    }

}

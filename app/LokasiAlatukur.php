<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiAlatukur extends Model
{
    protected $fillable = ['lokasi_alatukur'];

    protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempatKalibrasi extends Model
{
    protected $fillable = ['tempat_kalibrasi', 'alamat'];

    protected $hidden = ['created_at', 'updated_at'];
}

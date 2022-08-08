<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    // protected $fillable = ['idkaryawan', 'nama_pic', 'departemen_id', 'foto'];
    protected $guarded =['id'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function alatukur()
    {
        return $this->hasMany(Alatukur::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjams';

    protected $fillable = ['nama_peminjam', 'alatukur_id', 'tgl_pinjam', 'tgl_kembali', 'departemen_id'];

    protected $hidden = ['created_at', 'updated_at'];
    
    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
    public function alatukur()
    {
        return $this->belongsTo(Alatukur::class);
    }
}

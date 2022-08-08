<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    // protected $fillable = ['nama_departemen'];
    protected $guarded =['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function pic()
    {
        return $this->hasMany(Pic::class);
    }
}

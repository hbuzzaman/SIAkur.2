<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    use HasFactory;
    // protected $fillable = ['nama_maker'];
    protected $guarded =['id'];
    protected $hidden = ['created_at', 'updated_at'];
}

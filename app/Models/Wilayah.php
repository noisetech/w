<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wilayah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wilayah';

    protected $fillable = [
        'wilayah'
    ];

    public function dinas(){
        return $this->hasOne(Dinas::class, 'wilayah_id');
    }
}

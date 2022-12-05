<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerencanaanPembangunan extends Model
{
    use HasFactory;

    protected $table = 'perencanaan_pembangunan';

    protected $fillable = [
        'parent', 'perencanaan'
    ];
}

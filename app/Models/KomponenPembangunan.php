<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenPembangunan extends Model
{
    use HasFactory;

    protected $table = 'komponen_pembangunan';

    protected $fillable = [
        'parent', 'komponen'
    ];
}

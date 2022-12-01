<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    // use HasFactory;

    protected $table = 'unit';

    protected $fillable = [
        'urusan_id', 'kode', 'nomenklatur'
    ];

    public function urusan()
    {
        return $this->belongsTo(Urusan::class, 'urusan_id', 'id');
    }
}

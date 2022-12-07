<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    use HasFactory;

    protected $table = 'urusan';

    protected $fillable = [
        'kode', 'nomenklatur'
    ];

    public function bidang()
    {
        return $this->hasMany(Bidang::class, 'urusan_id');
    }

    public function dpa()
    {
        return $this->hasMany(Dpa::class, 'urusan_id');
    }
}

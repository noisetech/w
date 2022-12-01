<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organisasi';

    protected $fillable = [
        'kodeOrganisasi', 'urusan', 'nomenklatur'
    ];
}

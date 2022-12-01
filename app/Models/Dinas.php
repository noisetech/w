<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dinas extends Model
{
    use HasFactory;


    protected $table = 'dinas';

    protected $fillable = [
        'wilayah_id', 'dinas', 'logo', 'icon'
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'dinas_id');
    }
}

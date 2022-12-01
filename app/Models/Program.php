<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    public  $table = 'program';

    protected $fillable = [
        'id_bidang', 'kode', 'nomenklatur'
    ];

    public function bidang(){
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id');
    }


}

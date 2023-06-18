<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelesaiFisik extends Model
{
    protected $table = 'selesai_fisik';

    protected $fillable = [
        'lop_id',
        'evidence_selesai',
        'keterangan_selesai'
    ];

    use HasFactory;
}

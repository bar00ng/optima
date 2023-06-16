<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlokasiMitra extends Model
{
    protected $table = "alokasi_mitra";

    protected $fillable = [
        'lop_id',
        'alokasi_mitra'
    ];

    use HasFactory;
}

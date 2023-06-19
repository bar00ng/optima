<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $table = "validasi";

    protected $fillable = [
        'lop_id',
        'keterangan_validasi'
    ];

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persiapan extends Model
{
    protected $table = 'persiapan';

    protected $fillable = [
        'lop_id',
        'evidence_persiapan',
        'keterangan_persiapan'
    ];

    use HasFactory;
}

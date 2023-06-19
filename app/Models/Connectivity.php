<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connectivity extends Model
{
    protected $table = 'connectivity';

    protected $fillable = [
        'lop_id',
        'keterangan_connectivity'
    ];

    use HasFactory;
}

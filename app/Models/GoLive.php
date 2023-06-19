<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoLive extends Model
{
    protected $table = "go_live";

    protected $fillable = [
        'lop_id',
        'is_withGolive',
        'evidence_golive',
        'keterangan_withGoLive',
        'keterangan_withoutGoLive'
    ];

    use HasFactory;
}

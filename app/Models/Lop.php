<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListPermintaan;

class Lop extends Model
{
    protected $table = "lop";

    protected $fillable = [
        'permintaan_id',
        'nama_lop',
        'tematik_lop',
        'estimasi_rab',
        'sto',
        'tikor_lop',
        'keterangan',
        'status'
    ];

    use HasFactory;

    public function listPermintaan() {
        return $this->belongsTo(ListPermintaan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListPermintaan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lop extends Model
{
    protected $table = "lop";

    protected $fillable = [
        'tanggal_permintaan',
        'permintaan_id',
        'nama_lop',
        'tematik_lop',
        'estimasi_rab',
        'sto',
        'longitude',
        'latitude',
        'lokasi_lop',
        'keterangan_lop',
        'rab_ondesk',
        'keterangan_rab',
        'alokasi_mitra',
        'status'
    ];

    use HasFactory;

    public function listPermintaan(): BelongsTo {
        return $this->belongsTo(ListPermintaan::class, 'permintaan_id', 'id');
    }
}

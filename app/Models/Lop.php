<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListPermintaan;
use App\Models\Persiapan;
use App\Models\Instalasi;
use App\Models\SelesaiFisik;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function persiapan(): HasOne {
        return $this->hasOne(Persiapan::class, 'lop_id', 'id');
    }

    public function instalasi(): HasOne {
        return $this->hasOne(Instalasi::class, 'lop_id', 'id');
    }

    public function selesaiFisik(): HasOne {
        return $this->hasOne(selesaiFisik::class, 'lop_id', 'id');
    }
}

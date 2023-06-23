<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListPermintaan;
use App\Models\Persiapan;
use App\Models\Instalasi;
use App\Models\SelesaiFisik;
use App\Models\Validasi;
use App\Models\KonfirmasiMitra;
use App\Models\Connectivity;
use App\Models\GoLive;
use App\Models\Mitra;
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
        return $this->hasOne(SelesaiFisik::class, 'lop_id', 'id');
    }

    public function validasi(): HasOne {
        return $this->hasOne(Validasi::class, 'lop_id', 'id');
    }

    public function konfirmasiMira(): HasOne {
        return $this->hasOne(KonfirmasiMitra::class, 'lop_id', 'id');
    }

    public function connectivity(): HasOne {
        return $this->hasOne(Connectivity::class, 'lop_id', 'id');
    }

    public function goLive(): HasOne {
        return $this->hasOne(GoLive::class, 'lop_id', 'id');
    }

    public function mitra(): HasOne {
        return $this->hasOne(Mitra::class, 'lop_id', 'id');
    }
}

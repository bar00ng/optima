<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lop;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class KonfirmasiMitra extends Model
{
    protected $table = 'konfirmasi_mitra';

    protected $fillable = [
        'lop_id',
        'keterangan_konfirmasi_mitra',
        'konfirmasi_mitra_progress'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }
}

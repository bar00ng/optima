<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lop;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Validasi extends Model
{
    protected $table = "validasi";

    protected $fillable = [
        'lop_id',
        'keterangan_validasi',
        'validasi_progress'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }
}

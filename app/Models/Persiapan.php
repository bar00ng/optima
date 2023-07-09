<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Lop;

class Persiapan extends Model
{
    protected $table = 'persiapan';

    protected $fillable = [
        'lop_id',
        'evidence_persiapan',
        'keterangan_persiapan',
        'isApproved'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }
}

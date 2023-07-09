<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Lop;

class SelesaiFisik extends Model
{
    protected $table = 'selesai_fisik';

    protected $fillable = [
        'lop_id',
        'evidence_selesai',
        'keterangan_selesai',
        'isApproved'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }
}

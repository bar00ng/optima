<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Lop;
use App\Models\SelesaiFisikDetail;

class SelesaiFisik extends Model
{
    protected $table = 'selesai_fisik';

    protected $fillable = [
        'lop_id',
        'keterangan_selesai',
        'isApproved',
        'data'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }

    public function selesaiFisikDetail() {
        return $this->hasMany(SelesaiFisikDetail::class, 'selesai_fisik_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lop;

class GoLive extends Model
{
    protected $table = "go_live";

    protected $fillable = [
        'lop_id',
        'isNeed',
        'evidence_golive',
        'keterangan_withGoLive',
        'keterangan_withoutGoLive'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lop;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Connectivity extends Model
{
    protected $table = 'connectivity';

    protected $fillable = [
        'lop_id',
        'keterangan_connectivity',
        'connectivity_progress'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }
}

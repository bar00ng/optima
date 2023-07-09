<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Lop;

class Instalasi extends Model
{
    protected $table = 'instalasi';
    
    protected $fillable = [
        'lop_id',
        'evidence_instalasi',
        'keteranga_instalasi',
        'isApproved'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }
}

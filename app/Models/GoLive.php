<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lop;
use App\Models\WithGoLive;
use App\Models\WithoutGoLive;

class GoLive extends Model
{
    protected $table = "go_live";

    protected $fillable = [
        'lop_id',
        'isNeed',
        'isApproved'
    ];

    use HasFactory;

    public function lop(): BelongsTo {
        return $this->belongsTo(Lop::class, 'lop_id', 'id');
    }

    public function withoutGoLive() {
        return $this->hasOne(WithoutGoLive::class, 'go_live_id', 'id');
    }

    public function withGoLive() {
        return $this->hasOne(WithGoLive::class, 'go_live_id', 'id');
    }
}

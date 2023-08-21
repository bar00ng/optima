<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GoLive;
use App\Models\WithGoLive;

class WithGoLive extends Model
{
    use HasFactory;

    protected $table = 'with_go_live';

    protected $fillable = [
        'go_live_id',
        'evidence_golive',
        'keterangan_golive'
    ];

    public function goLive() {
        return $this->belongsTo(GoLive::class, 'go_live_id', 'id');
    }

    public function withGoLiveDetail() {
        return $this->hasMany(WithGoLiveDetail::class, 'with_golive_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WithGoLive;

class WithGoLiveDetail extends Model
{
    use HasFactory;

    protected $table = 'with_golive_detail';

    protected $fillable = [
        'with_golive_id',
        'evidence_name',
        'isApproved'
    ];

    public function withGoLive() {
        return $this->belongsTo(WithGoLive::class, 'with_golive_id', 'id');
    }
}

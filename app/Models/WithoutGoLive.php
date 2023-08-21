<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GoLive;

class WithoutGoLive extends Model
{
    use HasFactory;

    protected $table = 'without_go_live';

    protected $fillable = [
        'go_live_id',
        'keterangan_golive'
    ];

    public function goLive() {
        return $this->belongsTo(GoLive::class, 'go_live_id', 'id');
    }
}

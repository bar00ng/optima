<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SelesaiFisik;

class SelesaiFisikDetail extends Model
{
    use HasFactory;

    protected $table = "selesai_fisik_detail";

    protected $fillable = [
        'selesai_fisik_id',
        'evidence_name',
        'isApproved'
    ];

    public function selesaiFisik() {
        return $this->belongsTo(SelesaiFisik::class, 'selesai_fisik_id', 'id');
    }
}

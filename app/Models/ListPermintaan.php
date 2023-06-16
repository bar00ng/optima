<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lop;

class ListPermintaan extends Model
{
    protected $table = 'list_permintaan';

    protected $fillable = [
        'tanggal_permintaan',
        'tematik_permintaan',
        'refferal_permintaan',
        'nama_permintaan',
        'pic_permintaan',
        'keterangan',
        'status'
    ];

    public function lop()
    {
        return $this->hasOne(Lop::class);
    }

    use HasFactory;
}

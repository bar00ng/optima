<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    use HasFactory;
}

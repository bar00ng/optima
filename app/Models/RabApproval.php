<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabApproval extends Model
{
    protected $table = 'rab_approval';

    protected $fillable = [
        'lop_id',
        'isApproved'
    ];

    use HasFactory;
}

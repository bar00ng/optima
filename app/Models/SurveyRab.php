<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyRab extends Model
{
    protected $table = "survey_rab";

    protected $fillable = [
        'lop_id',
        'rab_ondesk',
        'keterangan'
    ];

    use HasFactory;
}

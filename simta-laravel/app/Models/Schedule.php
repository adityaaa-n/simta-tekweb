<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public $timestamps = false;

    protected $fillable = [
        'proposal_id',
        'tanggal',
        'waktu',
        'ruang'
    ];
}
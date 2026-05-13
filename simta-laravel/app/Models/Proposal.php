<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposals';

    public $timestamps = false;

    protected $fillable = [
        'mhs_id',
        'dsn_id',
        'judul',
        'deskripsi',
        'status',
        'file_path',
        'status_dokumen'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mhs_id');
    }
}
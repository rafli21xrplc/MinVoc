<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'konsep',
        'judul',
        'audio',
        'harga',
        'artist_id',
        'request_project_artis_id',
        'status',
        'pengajuan_project',
        'pembuat_project',
        'penerima_project',
        'is_reject',
    ];

    public function artis()
    {
        return $this->hasOne(artist::class, 'id', 'artist_id');
    }

}

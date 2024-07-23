<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterdataModel extends Model
{
    use HasFactory;

     protected $table = 'trip';

    protected $fillable = [
        'kode_trip',
        'judul_trip',
        'nama_sekolah'
    ];
}

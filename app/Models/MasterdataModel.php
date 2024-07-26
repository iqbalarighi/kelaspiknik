<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterdataModel extends Model
{
    use HasFactory;

     protected $table = 'sekolah';

    protected $fillable = [
        'nama_sekolah',
        'alamat_sekolah'
    ];
}

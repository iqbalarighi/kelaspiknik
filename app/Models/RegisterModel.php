<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterModel extends Model
{
    use HasFactory;

    protected $table = 'data_registrasi';

    protected $fillable = [
        'sekolah',
        'nama_lengkap', 
        'kelas',
        'nis',
        'ttl',
        'alamat',
        'email',
        'no_tel',
        'no_wa',
        'foto',
        'nm_ortu',
        'no_tel_ortu1',
        'no_tel_ortu2'
    ];
}

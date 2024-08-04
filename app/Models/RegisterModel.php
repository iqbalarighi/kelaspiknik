<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\TripModel;

class RegisterModel extends Model
{
    use HasFactory;

    protected $table = 'data_registrasi';

    protected $fillable = [
        'id_reg',
        'kode_trip',
        'bus',
        'sekolah',
        'nama_lengkap', 
        'kelas',
        'ttl',
        'penyakit',
        'alamat',
        'email',
        'no_tel',
        'no_wa',
        'foto',
        'nm_ortu',
        'no_tel_ortu1',
        'no_tel_ortu2'
    ];

    public function trip(): BelongsTo
{
    return $this->belongsTo(TripModel::class, 'kode_trip');
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RegisterModel;

class TripModel extends Model
{
    use HasFactory;

     protected $table = 'trip';

    protected $fillable = [
        'kode_trip',
        'judul_trip',
        'nama_sekolah',
        'jumlah_bus',
        'kapasitas'
    ];

    public function register()
    {
       return $this->hasOne(RegisterModel::class);
    }
}

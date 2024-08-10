<?php

namespace Database\Seeders;

use App\Models\EmailModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailModel::create([
            'isi' => 'ini isi dari email yang akan di kirim ke pendaftar',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterModel;
use Illuminate\Support\Facades\Crypt;

class AbsensiController extends Controller
{
    public function absen($id_reg)
    {

        $decrypted = Crypt::decryptString($id_reg);
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

if ($data == true){
        $nama = $data->nama_lengkap;
    return back()
        ->with('sukses', $nama);
    } else {
       return back()
        ->with('error', 'QRCode tidak valid'); 
    }

        
    }

    public function enkripsi()
    {
        $text = 'REG072400003';
        $encrypted = Crypt::encryptString($text);

        dd($encrypted, $text);
    }

    public function qrgen()
    {
       $data = RegisterModel::latest()->get();

       return view('qrcode.qrgen', compact('data'));
    }
}

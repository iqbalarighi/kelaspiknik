<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\RegisterModel;

class AbsensiController extends Controller
{

    public function index()
    {
        return view('absensi.index');
    }

    public function qrcode()
    {
        $agent = new Agent();

        return view('absensi.qrcode', compact('agent'));
    }

    public function absen($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
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

       return view('absensi.qrgen', compact('data'));
    }
}

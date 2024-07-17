<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterModel;
use Carbon\Carbon;

class RegisterController extends Controller
{
   public function form(){
       return view('registrasi.index');
   }

   public function save(Request $request)
   {

   $ttl = $request->tempat.', '. Carbon::parse($request->tgl)->isoFormat('DD MMMM YYYY');
      // dd($ttl);

      $data = new RegisterModel;

      $files = $request->file('images');
      $nod = $request->sekolah;
        $image = [];

        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/'.$nod.'/'.$request->nama.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }
        }

      $data->sekolah = $request->sekolah;
      $data->nama_lengkap = $request->nama;
      $data->kelas = $request->kelas;
      $data->nis = $request->nis;
      $data->ttl = $ttl;
      $data->penyakit = $request->penyakit;
      $data->alamat = $request->alamat;
      $data->email = $request->email;
      $data->no_tel = $request->notel;
      $data->no_wa = $request->nowa;
      $data->foto = implode('|', $image);
      $data->nm_ortu = $request->nm_ortu;
      $data->no_tel_ortu1 = $request->notel_ortu_1;
      $data->no_tel_ortu2 = $request->notel_ortu_2;

      $data->save();

      return back()
      ->with('sukses', 'Data Registrasi Anda Telah Tersimpan');
   }
   
}
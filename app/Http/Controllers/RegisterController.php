<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\RegisterModel;
use App\Models\MasterdataModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use Carbon\Carbon;
use File;

class RegisterController extends Controller
{
   public function form(Request $request){

    // dd(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 5));
    $kode = $request->kode_trip;

      if($kode != null){
        $data = MasterdataModel::where('kode_trip', $kode)->first();
            
            if($data == null){
                return back()
                ->with('error', 'Kode Trip Tidak Ditemukan');
            }
       return view('registrasi.index', compact('data', 'kode'));
      } else {
        $data = null;
        return view('registrasi.index', compact('data'));
      }
   }

   public function save(Request $request, $kode)
   {


//start of validator

$input = request()->all();

    $validator = Validator::make($input, [
                'images' => 'image|mimes:jpeg,png,jpg|max:2048',
                'images2' => 'image|mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'images.image' => 'Foto Dokumentasi harus berupa Gambar',
                'images.mimes' => 'File yang diterima hanya format :values',
                'images.max' => 'Ukuran Foto melebihi 2048 KB (2 MB)',
                'images2.image' => 'Foto Dokumentasi harus berupa Gambar',
                'images2.mimes' => 'File yang diterima hanya format :values',
                'images2.max' => 'Ukuran Foto melebihi 2048 KB (2 MB)',
            ]);

    if ($validator->fails()) {
        $messages = $validator->messages();
        return back()
            ->withInput()
            ->withErrors($messages);
    }

//end of validator

    $year = Carbon::now()->format('Y');
    $month = Carbon::now()->format('m');
    $th = Str::substr($year, -2);
    $string = 'REG'.$month.$th.'';
    $id_reg = Helper::IDGenerator(new RegisterModel, 'id_reg', 5, $string); /** Generate id */


   $ttl = $request->tempat.', '. $request->tgl;
      // dd($ttl);

      $data = new RegisterModel;

      $files = $request->file('images');
      $files2 = $request->file('images2');

      if ($files != null){
         $foto = $request->file('images');
         $image_name = md5(rand(100, 1000));
         $ext = strtolower($foto->getClientOriginalExtension());
         $imageName = $image_name.'.'.$ext;
         $foto->move(public_path('storage/registrasi/'.$kode.'/'.$id_reg.'/'), $imageName);
         $data->foto = $imageName;
      }

      if ($files2 != null){
         $surat = $request->file('images2');
         $image_name = md5(rand(100, 1000));
         $ext = strtolower($surat->getClientOriginalExtension());
         $imageName = $image_name.'.'.$ext;
         $surat->move(public_path('storage/registrasi/'.$kode.'/'.$id_reg.'/'), $imageName);
         $data->surat = $imageName;
      }

      $data->id_reg = $id_reg;
      $data->kode_trip = $kode;
      $data->sekolah = $request->sekolah;
      $data->nama_lengkap = $request->nama;
      $data->kelas = $request->kelas;
      $data->ttl = $ttl;
      $data->penyakit = $request->penyakit;
      $data->alamat = $request->alamat;
      $data->email = $request->email;
      $data->no_tel = $request->notel;
      $data->no_wa = $request->nowa;
      // $data->foto = implode('|', $image);
      $data->nm_ortu = $request->nm_ortu;
      $data->no_tel_ortu1 = $request->notel_ortu_1;
      $data->no_tel_ortu2 = $request->notel_ortu_2;

      $data->save();

      return back()
      ->with('sukses', 'Data Registrasi Anda Telah Tersimpan'); 
   }
   
}
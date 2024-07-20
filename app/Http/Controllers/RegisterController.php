<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\RegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use Carbon\Carbon;
use File;

class RegisterController extends Controller
{
   public function form(){
       return view('registrasi.index');
   }

   public function save(Request $request)
   {


//start of validator

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
      $nod = $request->sekolah;
        // $image = [];

        // if ($files != null) {
        //     foreach ($files as $file) {
        //         $image_name = md5(rand(100, 1000));
        //         $ext = strtolower($file->getClientOriginalExtension());
        //         $image_full_name = $image_name.'.'.$ext;
        //         $image_path = public_path('storage/registrasi/'.$nod.'/'.$request->nama.'/');
        //         $image_url = $image_path.$image_full_name;
        //         $file->move($image_path, $image_full_name);
        //         $image[] = $image_full_name;
        //     }
        // }

        if ($files != null) {
                $image_name = md5(rand(10, 100));
                $ext = strtolower($files->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/registrasi/'.$id_reg.'/');
                $image_url = $image_path.$image_full_name;
                !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
                // ResizeImage::make($files)
                //      ->orientate()
                //      ->resize(200, 300)
                //      ->save($image_path.$image_full_name);
                $files->move($image_path, $image_full_name);
                $image = $image_full_name;

                $data->foto = $image;
        }
                if ($files2 != null) {
                $image_name = md5(rand(10, 100));
                $ext = strtolower($files2->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/registrasi/'.$id_reg.'/');
                $image_url = $image_path.$image_full_name;
                !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
                // ResizeImage::make($files)
                //      ->orientate()
                //      ->resize(200, 300)
                //      ->save($image_path.$image_full_name);
                $files2->move($image_path, $image_full_name);   
                $image2 = $image_full_name;

                $data->surat = $image2;
        }







      $data->id_reg = $id_reg;
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
      // $data->foto = implode('|', $image);
      $data->nm_ortu = $request->nm_ortu;
      $data->no_tel_ortu1 = $request->notel_ortu_1;
      $data->no_tel_ortu2 = $request->notel_ortu_2;

      $data->save();

      return back()
      ->with('sukses', 'Data Registrasi Anda Telah Tersimpan');
   }
   
}
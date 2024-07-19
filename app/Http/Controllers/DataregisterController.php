<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DataregisterController extends Controller
{
   public function index()
   {
      $data = RegisterModel::latest()->paginate(10);

      return view('dataregister.index', compact('data'));
   }

   public function edit($id)
   {
      $data = RegisterModel::findOrFail($id);

      dd($data);
   }

   public function delete($id)
   {
      $data = RegisterModel::findOrFail($id);

         $del = File::deleteDirectory(public_path('storage/registrasi/'.$data->sekolah.'/'.$data->nama_lengkap));
      
      if ($del == true) {
            $data->delete();
       }

       return back()
       ->with('sukses','Data Registrasi Telah Terhapus');
   }
}

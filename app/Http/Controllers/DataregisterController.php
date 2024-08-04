<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataregExport;
use App\Exports\NotelExport;
use App\Models\RegisterModel;
use Illuminate\Http\Request;
use App\Models\TripModel;
use File;

class DataregisterController extends Controller
{
   public function index(Request $req)
   { 
      $cari = $req->cari;
      if($cari != null){
         // dd($cari);
         $data = RegisterModel::whereHas('trip', function ($query) use ($cari){
              $query->where('kode_trip', 'like', '%'.$cari.'%')
                     ->orWhere('nama_sekolah', 'LIKE', '%'.$cari.'%');
          })
         ->orWhere('nama_lengkap', 'LIKE', '%'.$cari.'%')
         ->latest()->paginate(10);
         $data->appends(compact('cari'));

      } else {

      $data = RegisterModel::latest()->paginate(10);
      }

      return view('dataregister.index', compact('data', 'cari'));
   }

   public function exportexcel($cari)
   { 
      $trip = RegisterModel::with('trip')->where('kode_trip', 'LIKE', '%'.$cari.'%')
         ->orWhere('nama_lengkap', 'LIKE', '%'.$cari.'%')
         ->orWhere('sekolah', 'LIKE', '%'.$cari.'%')
         ->latest()
         ->get();

      $count = RegisterModel::with('trip')->where('kode_trip', 'LIKE', '%'.$cari.'%')
         ->orWhere('nama_lengkap', 'LIKE', '%'.$cari.'%')
         ->orWhere('sekolah', 'LIKE', '%'.$cari.'%')
         ->latest()
         ->count();

      return Excel::download(new DataregExport($cari, $count), 'Kelas Piknik Trip '.$trip[0]->kode_trip.'.xlsx');

   }

   public function exportnotel($cari)
   { 
      $trip = RegisterModel::with('trip')->where('kode_trip', 'LIKE', '%'.$cari.'%')
         ->orWhere('nama_lengkap', 'LIKE', '%'.$cari.'%')
         ->orWhere('sekolah', 'LIKE', '%'.$cari.'%')
         ->latest()
         ->get();
      
      $count = RegisterModel::with('trip')->where('kode_trip', 'LIKE', '%'.$cari.'%')
         ->orWhere('nama_lengkap', 'LIKE', '%'.$cari.'%')
         ->orWhere('sekolah', 'LIKE', '%'.$cari.'%')
         ->latest()
         ->count();

      return Excel::download(new NotelExport($cari, $count), 'Nomor Telepon Trip '.$trip[0]->kode_trip.'.xlsx');

   }

   public function edit($id)
   {
      $data = RegisterModel::where('id_reg', $id)->first();
      $jmlh = TripModel::where('kode_trip', $data->kode_trip)->first();
      $value = explode(',', $data->ttl);

      return view('dataregister.edit', compact('data', 'value', 'jmlh'));
   }

   public function update(Request $request, $id)
   {
      $data = RegisterModel::findOrFail($id);

      $ttl = $request->tempat.', '. $request->tgl;
      $nod = $data->id_reg;
      $kod = $data->kode_trip;

      if ($data->foto == null){
         $foto = $request->file('images');
         $image_name = md5(rand(100, 1000));
         $ext = strtolower($foto->getClientOriginalExtension());
         $imageName = $image_name.'.'.$ext;
         $foto->move(public_path('storage/registrasi/'.$kod.'/'.$nod.'/'), $imageName);
         $data->foto = $imageName;
      }

      if ($data->surat == null){
         $surat = $request->file('images2');
         $image_name = md5(rand(100, 1000));
         $ext = strtolower($surat->getClientOriginalExtension());
         $imageName = $image_name.'.'.$ext;
         $surat->move(public_path('storage/registrasi/'.$kod.'/'.$nod.'/'), $imageName);
         $data->surat = $imageName;
      }

      $data->bus = $request->bus;
      $data->sekolah = $request->sekolah;
      $data->nama_lengkap = $request->nama;
      $data->kelas = $request->kelas;
      $data->ttl = $ttl;
      $data->penyakit = $request->penyakit;
      $data->alamat = $request->alamat;
      $data->email = $request->email;
      $data->no_tel = $request->notel;
      $data->no_wa = $request->nowa;
      $data->nm_ortu = $request->nm_ortu;
      $data->no_tel_ortu1 = $request->notel_ortu_1;
      $data->no_tel_ortu2 = $request->notel_ortu_2;

      $data->save();

      return back()
      ->with('sukses', 'Data Telah Diperbarui');
   }


   public function delete($id)
   {
      $data = RegisterModel::findOrFail($id);

         $del = File::deleteDirectory(public_path('storage/registrasi/'.$data->kode_trip.'/'.$data->id_reg));
      
      if ($del == true) {
            $data->delete();
       }

       return back()
       ->with('sukses','Data Registrasi Telah Terhapus');
   }

   public function hapusfoto($id)
   {
     $data = RegisterModel::findOrFail($id);

      $del = File::delete(public_path('storage/registrasi/'.$data->kode_trip.'/'.$data->id_reg.'/'.$data->foto));
     
   if ($del == true){
      $data->foto = '';
      $data->save();
     } else {
      $data->foto = '';
      $data->save();
     }

     return back()
      ->with('sukses','Foto Peserta Telah Terhapus');
   }

   public function hapusurat($id)
   {
     $data = RegisterModel::findOrFail($id);

      $del = File::delete(public_path('storage/registrasi/'.$data->id_reg.'/'.$data->surat));
     
   if ($del == true){
      $data->surat = '';
      $data->save();
     } else {
      $data->surat = '';
      $data->save();
     }

     return back()
      ->with('sukses','Surat Pernyataan Terhapus');
   }

   public function detail($id_reg)
   {
      $data = RegisterModel::where('id_reg', $id_reg)->first();

      $item = explode(',', $data->ttl);

      // dd($item[0]);

      return view('dataregister.detail', compact('data', 'item'));
   }

}

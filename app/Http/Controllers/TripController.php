<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TripModel;
use App\Models\RegisterModel;
use File;

class TripController extends Controller
{
   public function index()
   {
    $data = TripModel::latest()->paginate(15);
        

foreach ($data as $key => $value) {
    $kode = $value->kode_trip;
    if ($value->lama_trip == 2) {
    $dat = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })
        ->WhereNotNull('absen1')
        ->WhereNotNull('absen2')
        ->latest()
        ->count();

    $jum = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })->latest()->count();

    $juml[] = $jum;
    $dds[] = $dat;
    } elseif ($value->lama_trip == 3) {
    $dat = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })
        ->WhereNotNull('absen1')
        ->WhereNotNull('absen2')
        ->WhereNotNull('absen3')
        ->latest()
        ->count();

    $jum = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })->latest()->count();

    $juml[] = $jum;
    $dds[] = $dat;
    } elseif ($value->lama_trip == 4) {
    $dat = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })
        ->WhereNotNull('absen1')
        ->WhereNotNull('absen2')
        ->WhereNotNull('absen3')
        ->WhereNotNull('absen4')
        ->latest()
        ->count();

    $jum = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })->latest()->count();

    $juml[] = $jum;
    $dds[] = $dat;
    } elseif ($value->lama_trip == 5) {
    $dat = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })
        ->WhereNotNull('absen1')
        ->WhereNotNull('absen2')
        ->WhereNotNull('absen3')
        ->WhereNotNull('absen4')
        ->WhereNotNull('absen5')
        ->latest()
        ->count();

    $jum = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })->latest()->count();

    $juml[] = $jum;
    $dds[] = $dat;
    } elseif ($value->lama_trip == 6) {
    $dat = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })
        ->WhereNotNull('absen1')
        ->WhereNotNull('absen2')
        ->WhereNotNull('absen3')
        ->WhereNotNull('absen4')
        ->WhereNotNull('absen5')
        ->WhereNotNull('absen6')
        ->latest()
        ->count();

    $jum = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })->latest()->count();

    $juml[] = $jum;
    $dds[] = $dat;
    } elseif ($value->lama_trip == 7) {
    $dat = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })
        ->WhereNotNull('absen1')
        ->WhereNotNull('absen2')
        ->WhereNotNull('absen3')
        ->WhereNotNull('absen4')
        ->WhereNotNull('absen5')
        ->WhereNotNull('absen6')
        ->WhereNotNull('absen7')
        ->latest()
        ->count();

    $jum = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })->latest()->count();

    $juml[] = $jum;
    $dds[] = $dat;
    } elseif ($value->lama_trip == 8) {
    $dat = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })
        ->WhereNotNull('absen1')
        ->WhereNotNull('absen2')
        ->WhereNotNull('absen3')
        ->WhereNotNull('absen4')
        ->WhereNotNull('absen5')
        ->WhereNotNull('absen6')
        ->WhereNotNull('absen7')
        ->WhereNotNull('absen8')
        ->latest()
        ->count();

    $jum = RegisterModel::with('trip')
         ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })->latest()->count();

    $dds[] = $dat;
    $juml[] = $jum;
    }

}
// dd($juml, $dds);
       return view('trip.index', compact('data', 'juml', 'dds'));
   }

public function input()
{
    return view('trip.inputtrip');
}

public function bus(Request $request)
    {
        $bus = $request->bus;
        $kode = $request->kode;

        if($request->ajax()){

             $bus = RegisterModel::with('trip')
             ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
          })
                    ->where('bus', 'LIKE', '%'.$bus. '%')
                    ->count();

        $dat = TripModel::where('kode_trip', $kode)->first();
            

            $bus2 = $request->bus;

$data = ['bus' => $bus, 'bus2' => $bus2, 'limit' => $dat->kapasitas];

return response()->json($data);


    }

    }

public function save(Request $request)
 {
    $month = Carbon::now()->format('m');
   
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        } 

        $string = $month.$randomString;


    $data = new TripModel;

    $data->kode_trip = $string;
    $data->judul_trip = $request->judul_trip;
    $data->nama_sekolah = $request->nama;
    $data->jumlah_bus = $request->bus;
    $data->kapasitas = $request->kapasitas;
    $data->lama_trip = $request->lama_trip;

     $files = $request->file('images');

      if ($files != null){
         $foto = $request->file('images');
         $image_name = md5(rand(100, 1000));
         $ext = strtolower($foto->getClientOriginalExtension());
         $imageName = $image_name.'.'.$ext;
         $foto->move(public_path('storage/trip/'.$string.'/'), $imageName);
         $data->file = $imageName;
      }

    $data->save();

    return back()
      ->with('sukses', 'Data Trip Tersimpan');
 }

   public function delete($id)
   {
        $data = TripModel::findOrFail($id);
        $data->delete();

       return back()
       ->with('sukses','Data Sekolah Telah Terhapus');
   }

public function buat($value='')
{
        $month = Carbon::now()->format('m');
   
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        } 

        $string = $month.$randomString;
}

public function edit($id)
{
    $data = TripModel::findOrFail($id);

    return view('trip.edit', compact('data'));
}

public function update(Request $request, $id)
{
    $data = TripModel::findOrFail($id);
    
    $data->judul_trip = $request->judul_trip;
    $data->nama_sekolah = $request->nama;
    $data->jumlah_bus = $request->bus;
    $data->kapasitas = $request->kapasitas;
    $data->lama_trip = $request->lama_trip;

        $files = $request->file('images');

      if ($files != null){
         $foto = $request->file('images');
         $image_name = md5(rand(100, 1000));
         $ext = strtolower($foto->getClientOriginalExtension());
         $imageName = $image_name.'.'.$ext;
         $foto->move(public_path('storage/trip/'.$data->kode_trip.'/'), $imageName);
         $data->file = $imageName;
      }

    $data->save();

    return back()
      ->with('sukses', 'Perubahan Data Tersimpan');
}

public function hpscard($id)
{
     $data = TripModel::findOrFail($id);

     $del = File::delete(public_path('storage/trip/'.$data->kode_trip.'/'.$data->file));
     
     if ($del == true){
          $data->file = null;
          $data->save();
     } else {
          $data->file = null;
          $data->save();
     }

     return back()
      ->with('sukses','Layout Idcard Terhapus');
}

}

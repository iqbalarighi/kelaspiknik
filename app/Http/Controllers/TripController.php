<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TripModel;
use App\Models\RegisterModel;

class TripController extends Controller
{
   public function index()
   {
    $data = TripModel::latest()->paginate(15);

       return view('trip.index', compact('data'));
   }

public function input()
{
    return view('trip.inputtrip');
}

public function bus(Request $request)
    {
        if($request->ajax()){

             $bus = RegisterModel::where('kode_trip', 'LIKE', '%'.$request->kode. '%') // ini hiutng jumlah bus
                    ->where('bus', 'LIKE', '%'.$request->bus. '%')
                    ->count();

        $dat = TripModel::where('kode_trip', $request->kode)->first();
            

            $bus2 = $request->bus;

$data = ['bus' => $bus, 'bus2' => $bus2, 'limit' => $dat->kapasitas];

            // if ($bus < 2){
            //     $hasil =  '<font style="color:green">Bus masih tersedia <i style="font-size:15pt;" class="bi bi-check-circle-fill ps-3"></i></font>';
            // } else {
            //     $hasil = '<font style="color:red"> Bus tidak tersedia <i style="font-size:15pt;" class="bi bi-x-circle-fill ps-3"></i></font>';
            // }

return response()->json($data);


    }

    }

public function save(Request $request)
 {
    $month = Carbon::now()->format('m');
   
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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

    $data->save();

    return back()
      ->with('sukses', 'Purubahan Data Tersimpan');
}
}

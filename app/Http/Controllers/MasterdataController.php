<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterdataModel;

class MasterdataController extends Controller
{
   public function index()
   {
    $data = MasterdataModel::latest()->paginate(10);

       return view('masterdata.index', compact('data'));
   }

public function input()
{
    return view('masterdata.inputtrip');
}

public function school(Request $request)
    {
        $scl = MasterdataModel::where('nama_sekolah', 'LIKE', '%'.$request->get('term'). '%')
                    ->distinct()
                    ->get();

        foreach ($scl as $school)
            {
                $dat['id'] = $school->nama_sekolah;
                $dat['lokasi'] = $school->nama_sekolah;

                $data[] = $dat;
            }

return response()->json($data);
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


    $data = new MasterdataModel;

    $data->kode_trip = $string;
    $data->judul_trip = $request->judul_trip;
    $data->nama_sekolah = $request->nama;

    $data->save();

    return back()
      ->with('sukses', 'Data Trip Tersimpan');
 }

   public function delete($id)
   {
        $data = MasterdataModel::findOrFail($id);
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
}

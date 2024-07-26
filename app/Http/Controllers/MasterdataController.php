<?php

namespace App\Http\Controllers;

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
    return view('masterdata.inputsekolah');
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
    $data = new MasterdataModel;

    $data->nama_sekolah = $request->nama;
    $data->alamat_sekolah = $request->alamat;

    $data->save();

    return back()
      ->with('sukses', 'Data Sekolah Telah Tersimpan');
 }

   public function delete($id)
   {
        $data = MasterdataModel::findOrFail($id);
        $data->delete();

       return back()
       ->with('sukses','Data Sekolah Telah Terhapus');
   }

}

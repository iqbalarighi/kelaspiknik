<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\RegisterModel;
use App\Models\TripModel;
use Carbon\Carbon;
use PDF;

class AbsensiController extends Controller
{

    public function index(Request $request)
    {
        $absen = $request->absen;
        $kode_trip = $request->kode_trip;
        $bus = $request->bus;
        $agent = new Agent();

        if($request->kode_trip != null && $request->bus == null){
            $data = RegisterModel::with('trip')
            ->whereRelation('trip', function ($query) use ($kode_trip){
              $query->where('kode_trip', 'like', '%'.$kode_trip.'%');
                    })
                    ->paginate(10);
            $data->appends(compact('kode_trip'));

            $trip = TripModel::where('kode_trip', $kode_trip)->first();
            $kode = TripModel::get('kode_trip');

            return view('absensi.index', compact('data', 'trip', 'kode_trip', 'bus', 'kode', 'agent', 'absen'));
        } elseif($request->kode_trip != null && $bus != null){
            $data = RegisterModel::with('trip')
            ->whereRelation('trip', function ($query) use ($kode_trip){
              $query->where('kode_trip', 'like', '%'.$kode_trip.'%');
                    })
                    ->Where('bus', $bus)
                    ->paginate(10);
            $data->appends(compact('kode_trip', 'bus', 'absen'));

            $trip = TripModel::where('kode_trip', $kode_trip)->first();
            $kode = TripModel::get('kode_trip');

            return view('absensi.index', compact('data', 'trip', 'kode_trip', 'bus', 'kode', 'agent', 'absen'));
        } else {
            $absen = null;
            $data = null;
            $debus = null;
            $agent = new Agent();
            $kode = TripModel::get('kode_trip');
            return view('absensi.index', compact('data', 'kode', 'agent', 'absen'));
        }



    }

    public function idcard()
    {
        $idcard = RegisterModel::get();

        return view('absensi.idcard', compact('idcard'));
    }

    public function cardpdf($kode, $bus)
    {

        $idcard = RegisterModel::with('trip')
            ->whereRelation('trip', function ($query) use ($kode){
              $query->where('kode_trip', 'like', '%'.$kode.'%');
                    })
                    ->Where('bus', $bus)
                    ->get();

         return view('absensi.idcard', compact('idcard'));
    }

    public function qrcode()
    {
        $agent = new Agent();

        return view('absensi.qrcode', compact('agent'));
    }


    // public function enkripsi()
    // {
    //     $text = 'REG072400003';
    //     $encrypted = Crypt::encryptString($text);

    //     dd($encrypted, $text);
    // }

    // public function qrgen()
    // {
    //    $data = RegisterModel::latest()->get();

    //    return view('absensi.qrgen', compact('data'));
    // }
    

//start Absensi ==========================================
    public function absen1($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::with('trip')->where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->trip->kode_trip;
            $idre = $data->id_reg;
        if($data->absen1 == null){
            $data->absen1 = Carbon::now()->parse()->format('Y-m-d');
            $data->save();

            return back()
            ->with('sukses', $nama.' berhasil melakukan absensi hari pertama')
            ->with('foto', $foto)
            ->with('kode', $kode)
            ->with('idre', $idre);
        } else {

            return back()
            ->with('warning', $nama.' sudah absensi hari pertama');
        }
        
        } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }

    public function absen2($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::with('trip')->where('id_reg', $decrypted)->first();

    if ($data->absen1 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari pertama!');
    } 

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->trip->kode_trip;
            $idre = $data->id_reg;

if(Carbon::now()->parse()->format('Y-m-d') == $data->absen1) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
}

        if($data->absen2 == null){
            $data->absen2 = Carbon::now()->parse()->format('Y-m-d');
            $data->save();

            return back()
            ->with('sukses', $nama.' berhasil melakukan absensi hari kedua')
            ->with('foto', $foto)
            ->with('kode', $kode)
            ->with('idre', $idre);
        } else {

            return back()
            ->with('warning', $nama.' sudah absensi hari kedua');
        } } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }

    public function absen3($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::with('trip')->where('id_reg', $decrypted)->first();

    if ($data->absen1 == null && $data->absen2 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari pertama dan hari kedua');
    } elseif ($data->absen2 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kedua');
    }


    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->trip->kode_trip;
            $idre = $data->id_reg;

if(Carbon::now()->parse()->format('Y-m-d') == $data->absen1) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen2) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
}
        if($data->absen3 == null){
            $data->absen3 = Carbon::now()->parse()->format('Y-m-d');
            $data->save();

            return back()
            ->with('sukses', $nama.' berhasil melakukan absensi hari ketiga')
            ->with('foto', $foto)
            ->with('kode', $kode)
            ->with('idre', $idre);
        } else {

            return back()
            ->with('warning', $nama.' sudah absensi hari ketiga');
        }
        
        } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }

    public function absen4($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::with('trip')->where('id_reg', $decrypted)->first();

    if ($data->absen1 == null && $data->absen2 == null && $data->absen3 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari pertama, kedua, dan ketiga');
    } elseif ($data->absen2 == null && $data->absen3 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kedua dan ketiga');
    } elseif ($data->absen3 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari ketiga');
    } 


    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->trip->kode_trip;
            $idre = $data->id_reg;

if(Carbon::now()->parse()->format('Y-m-d') == $data->absen1) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen2) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen3) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
}

        if($data->absen4 == null){
            $data->absen4 = Carbon::now()->parse()->format('Y-m-d');
            $data->save();

            return back()
            ->with('sukses', $nama.' berhasil melakukan absensi hari keempat')
            ->with('foto', $foto)
            ->with('kode', $kode)
            ->with('idre', $idre);
        } else {

            return back()
            ->with('warning', $nama.' sudah absensi hari keempat');
        }
        
        } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }

    public function absen5($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::with('trip')->where('id_reg', $decrypted)->first();

    if ($data->absen1 == null && $data->absen2 == null && $data->absen3 == null && $data->absen4 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari pertama, kedua, ketiga, dan keempat');
    } elseif ($data->absen2 == null && $data->absen3 == null && $data->absen4 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kedua, ketiga, dan keempat');
    } elseif ($data->absen3 == null && $data->absen4 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari ketiga dan keempat');
    } elseif ($data->absen4 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari keempat');
    } 

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->trip->kode_trip;
            $idre = $data->id_reg;

if(Carbon::now()->parse()->format('Y-m-d') == $data->absen1) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen2) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen3) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen4) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
}
        if($data->absen5 == null){
            $data->absen5 = Carbon::now()->parse()->format('Y-m-d');
            $data->save();

            return back()
            ->with('sukses', $nama.' berhasil melakukan absensi hari kelima')
            ->with('foto', $foto)
            ->with('kode', $kode)
            ->with('idre', $idre);
        } else {

            return back()
            ->with('warning', $nama.' sudah absensi hari kelima');
        }
        
        } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }

    public function absen6($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::with('trip')->where('id_reg', $decrypted)->first();

    if ($data->absen1 == null && $data->absen2 == null && $data->absen3 == null && $data->absen4 == null && $data->absen5 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari pertama, kedua, ketiga, keempat, dan kelima');
    } elseif ($data->absen2 == null && $data->absen3 == null && $data->absen4 == null && $data->absen5 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kedua, ketiga, keempat, dan kelima');
    } elseif ($data->absen3 == null && $data->absen4 == null && $data->absen5 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari ketiga, keempat, dan kelima');
    } elseif ($data->absen4 == null && $data->absen5 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari keempat, dan kelima');
    } elseif ($data->absen5 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kelima');
    } 

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->trip->kode_trip;
            $idre = $data->id_reg;

if(Carbon::now()->parse()->format('Y-m-d') == $data->absen1) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen2) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen3) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen4) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen5) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} 

        if($data->absen6 == null){
            $data->absen6 = Carbon::now()->parse()->format('Y-m-d');
            $data->save();


            return back()
            ->with('sukses', $nama.' berhasil melakukan absensi hari keenam')
            ->with('foto', $foto)
            ->with('kode', $kode)
            ->with('idre', $idre);
        } else {

            return back()
            ->with('warning', $nama.' sudah absensi hari keenam');
        }
        
        } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }

    public function absen7($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::with('trip')->where('id_reg', $decrypted)->first();

    if ($data->absen1 == null && $data->absen2 == null && $data->absen3 == null && $data->absen4 == null && $data->absen5 == null && $data->absen6 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari pertama, kedua, ketiga, keempat, kelima, dan keenam');
    } elseif ($data->absen2 == null && $data->absen3 == null && $data->absen4 == null && $data->absen5 == null && $data->absen6 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kedua, ketiga, keempat, kelima, dan keenam');
    } elseif ($data->absen3 == null && $data->absen4 == null && $data->absen5 == null && $data->absen6 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari ketiga, keempat, kelima, dan keenam');
    } elseif ($data->absen4 == null && $data->absen5 == null && $data->absen6 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari keempat, kelima, dan keenam');
    } elseif ($data->absen5 == null && $data->absen6 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kelima dan keenam');
    } elseif ($data->absen6== null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari keenam');
    } 

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->trip->kode_trip;
            $idre = $data->id_reg;

if(Carbon::now()->parse()->format('Y-m-d') == $data->absen1) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen2) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen3) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen4) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen5) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen6) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
}

        if($data->absen7 == null){
            $data->absen7 = Carbon::now()->parse()->format('Y-m-d');
            $data->save();

            return back()
            ->with('sukses', $nama.' berhasil melakukan absensi hari ketujuh')
            ->with('foto', $foto)
            ->with('kode', $kode)
            ->with('idre', $idre);
        } else {

            return back()
            ->with('warning', $nama.' sudah absensi hari ketujuh');
        }
        
        } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }

    public function absen8($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::with('trip')->where('id_reg', $decrypted)->first();

    if ($data->absen1 == null && $data->absen2 == null && $data->absen3 == null && $data->absen4 == null && $data->absen5 == null && $data->absen6 == null && $data->absen7 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari pertama, kedua, ketiga, keempat, kelima, keenam, dan ketujuh');
    } elseif ($data->absen2 == null && $data->absen3 == null && $data->absen4 == null && $data->absen5 == null && $data->absen6 == null && $data->absen7 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kedua, ketiga, keempat, kelima, keenam, dan ketujuh');
    } elseif ($data->absen3 == null && $data->absen4 == null && $data->absen5 == null && $data->absen6 == null && $data->absen7 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari ketiga, keempat, kelima, keenam, dan ketujuh');
    } elseif ($data->absen4 == null && $data->absen5 == null && $data->absen6 == null && $data->absen7 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari keempat, kelima, keenam, dan ketujuh');
    } elseif ($data->absen5 == null && $data->absen6 == null && $data->absen7 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari kelima, keenam, dan ketujuh');
    } elseif ($data->absen6== null && $data->absen7 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari keenam dan ketujuh');
    } elseif ($data->absen7 == null) {
        $nama = $data->nama_lengkap;
        return back()
            ->with('warning', $nama.' Belum absensi hari ketujuh');
    } 

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->trip->kode_trip;
            $idre = $data->id_reg;

if(Carbon::now()->parse()->format('Y-m-d') == $data->absen1) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen2) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen3) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen4) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen5) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen6) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
} elseif(Carbon::now()->parse()->format('Y-m-d') == $data->absen7) {
    return back()
     ->with('error', 'Tidak bisa absen hari berikutnya di hari yang sama'); 
}
        if($data->absen8 == null){
            $data->absen8 = Carbon::now()->parse()->format('Y-m-d');
            $data->save();

            return back()
            ->with('sukses', $nama.' berhasil melakukan absensi hari kedelapan')
            ->with('foto', $foto)
            ->with('kode', $kode)
            ->with('idre', $idre);
        } else {

            return back()
            ->with('warning', $nama.' sudah absensi hari kedelapan');
        }
        
        } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }
//end Absensi

        public function kode_trip(Request $request)
    {
        $kode = TripModel::where('kode_trip', 'LIKE', '%'.$request->get('term'). '%')
                    ->distinct()
                    ->get();

        foreach ($kode as $hsl)
            {
                $dat['kodex'] = $hsl->kode_trip;

                $data[] = $dat;
            }

return response()->json($data);
        
    }
}

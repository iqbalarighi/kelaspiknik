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
        $debus = $request->bus;
        $agent = new Agent();

        if($request->kode_trip != null && $request->bus == null){
            $data = RegisterModel::where('kode_trip', $request->kode_trip)
                    // ->orWhere('bus', $request->bus)
                    ->paginate(15);

            $bus = TripModel::where('kode_trip', $request->kode_trip)->get('jumlah_bus');
            $kode = TripModel::get('kode_trip');

            return view('absensi.index', compact('data', 'bus', 'kode_trip', 'debus', 'kode', 'agent', 'absen'));
        } elseif($request->kode_trip != null && $request->bus != null){
            $data = RegisterModel::where('kode_trip', $request->kode_trip)
                    ->Where('bus', $request->bus)
                    ->paginate(15);

            $bus = TripModel::where('kode_trip', $request->kode_trip)->get('jumlah_bus');
            $kode = TripModel::get('kode_trip');

            return view('absensi.index', compact('data', 'bus', 'kode_trip', 'debus', 'kode', 'agent', 'absen'));
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

        $data = RegisterModel::where('kode_trip', $kode)
                    ->Where('bus', $bus)
                    ->get();

        // $qrcode = QrCode::size(150)->style('dot')->generate();

        $pdf = PDF::loadView('absensi.cardpdf', compact('data'));

        return $pdf->stream('ID Card '.$kode.'.pdf');
    }

    public function qrcode()
    {
        $agent = new Agent();

        return view('absensi.qrcode', compact('agent'));
    }


    public function enkripsi()
    {
        $text = 'REG072400003';
        $encrypted = Crypt::encryptString($text);

        dd($encrypted, $text);
    }

    public function qrgen()
    {
       $data = RegisterModel::latest()->get();

       return view('absensi.qrgen', compact('data'));
    }
//start Absensi
    public function absen1($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->kode_trip;
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
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->kode_trip;
            $idre = $data->id_reg;
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
        }
        
        } else {
           return back()
            ->with('error', 'QRCode tidak valid'); 
        }

        
    }

    public function absen3($id_reg)
    {

        $decrypted = base64_decode(base64_decode($id_reg));
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->kode_trip;
            $idre = $data->id_reg;
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
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->kode_trip;
            $idre = $data->id_reg;
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
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->kode_trip;
            $idre = $data->id_reg;
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
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->kode_trip;
            $idre = $data->id_reg;
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
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->kode_trip;
            $idre = $data->id_reg;
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
        
        $data = RegisterModel::where('id_reg', $decrypted)->first();

    if ($data == true){
            $nama = $data->nama_lengkap;
            $foto = $data->foto;
            $kode = $data->kode_trip;
            $idre = $data->id_reg;
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
}

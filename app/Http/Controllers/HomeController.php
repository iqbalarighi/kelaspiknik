<?php

namespace App\Http\Controllers;

use App\Models\RegisterModel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kode = DB::table('trip')
          ->selectRaw('kode_trip as kode')
          ->distinct()
          ->limit(12)
          ->latest()
          ->pluck('kode');

        $tanggal = DB::table('trip')
          ->selectRaw('EXTRACT(YEAR_MONTH FROM created_at) as tanggal')
          ->distinct()
          ->limit(12)
          ->latest()
          ->pluck('tanggal');   

    foreach ($tanggal as $but) {
            $vc = $but.'01';
            $bulantahun[] = Carbon::parse($vc)->isoFormat('MMMM YYYY');
            $bultah[] = Carbon::parse($vc)->format('Y-m');
         }

            foreach ($kode as $key => $bbb) {
                $kod = $bbb; 
                    $jumtrip []= RegisterModel::with('trip')
                    ->whereRelation('trip', function ($query) use ($kod){
                      $query->where('kode_trip', $kod);
                  })
                    ->count();
    }

    foreach ($bultah as $key => $vs) {
        $total []= DB::table('data_registrasi')->select('created_at')
                    ->where('created_at','LIKE','%'.$vs.'%')
                    ->count();
    }

    foreach ($kode as $key => $value) {
        $trip[] = $value;
    }

        return view('home', compact('jumtrip', 'trip', 'bulantahun', 'total'));
    }
}

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
        $kode =   DB::table('trip')
          ->selectRaw('kode_trip as kode')
          ->distinct()
          ->latest()
          ->pluck('kode');


        // foreach ($data as $value) {
        //     $bul[] = Str::substr($value, 4,2);
        //     $tah[] = Str::substr($value, 0,4);
        //  }

            foreach ($kode as $key => $bbb) {
                    $data = RegisterModel::with('trip')
                    ->whereRelation('trip', function ($query) use ($bbb){
                      $query->where('kode_trip', 'like', '%'.$bbb.'%');
                  })
                    ->get();
    }

dd($data->count());

        return view('home');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailModel;

class EmailController extends Controller
{
    public function index()
    {
       $data = EmailModel::get();

       return view('mail.index', compact('data'));
    }

    public function test()
    {

        $details = [ 
        'nama' => 'rama', 
        'idreg' => '0123456789',
      ];
         $data = EmailModel::all();
         return view('registrasi.responsemail', compact('details','data'));
    }


}

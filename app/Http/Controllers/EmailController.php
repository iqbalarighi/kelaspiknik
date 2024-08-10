<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailModel;

class EmailController extends Controller
{
    public function index()
    {
       $data = EmailModel::findOrFail(1);

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

   public function update(Request $request, $id)
   {

     $data = EmailModel::findOrFail($id);

     $data->isi = $request->mail;

     $data->save();

     return back()
     ->with('status', 'berhasil di update');
   }

}

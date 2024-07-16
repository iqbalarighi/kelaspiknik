<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterModel;


class RegisterController extends Controller
{
   public function form(){
       return view('registrasi.index');
   }
   
}

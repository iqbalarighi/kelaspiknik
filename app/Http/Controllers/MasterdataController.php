<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterdataController extends Controller
{
   public function index()
   {
       return view('masterdata.index');
   }
}

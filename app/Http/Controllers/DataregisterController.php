<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterModel;

class DataregisterController extends Controller
{
   public function index()
   {
      $data = RegisterModel::paginate(10);

      return view('dataregister.index', compact('data'));
   }
}

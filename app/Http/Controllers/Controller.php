<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function indexs()
    {
        $data = User::paginate(15);

        return view('user.index', compact('data'));
    }

    public function simpan(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'email' => 'email|unique:users',
    ]);

if ($validator->fails()) {
    return back()
        ->withInput()
        ->with('error', 'Email sudah terdaftar');
}

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);


        return back()
        ->with('sukses', 'Data User Tersimpan');
    }
}

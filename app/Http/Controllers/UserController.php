<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
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
            'password' => Hash::make($request->pass, ['rounds' => 12,]),
        ]);


        return back()
        ->with('sukses', 'Data User Tersimpan');
    }
}
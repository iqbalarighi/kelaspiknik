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

    public function hapus($id)
    {
        $hapus = User::findOrFail($id);

        $hapus->delete();
        
       return back()
       ->with('sukses', 'User Terhapus');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('user.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
       $data = User::findOrFail($id);

       $data->name = $request->nama;
       $data->email = $request->email;
       $data->role = $request->role;
       $data->status = $request->status;
       if ($request->pass != null) {
       $data->password = bcrypt($request->pass, ['rounds' => 12],);
       }
       $data->save();


       return back()
       ->with('sukses', 'Data user telah diperbarui');
    }
}
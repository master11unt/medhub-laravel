<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Menampilkan semua data user
     */
    public function index()
    {
        $user = User::all();
        return view('Admin.User.indexU', compact('user'));
    }

    /**
     * Menambahkan user baru
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'=> 'required|',
            'email'=> 'required|email|unique:users',
            'phone'=> 'required',
            'tanggal_lahir'=> 'required',
            'no_ktp'=> 'required',
            'role'=> 'required',
            'jenis_kelamin'=> 'required',
            'password'=> 'required|min:6|confirmed',
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'tanggal_lahir'=> $request->tanggal_lahir,
            'role'=> $request->role,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'password'=> Hash::make($request->password),
            'no_ktp'=> $request->no_ktp, // default karena form tidak menyediakan input no_ktp
        ]);

        Session::flash('Sukses', 'Data User Berhasil Ditambahkan');
        return redirect()->route('index.user');
    }

    /**
     * Menghapus user berdasarkan ID
     */
    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect()->back()->with('Delete', 'Berhasil hapus data user');
    }
}

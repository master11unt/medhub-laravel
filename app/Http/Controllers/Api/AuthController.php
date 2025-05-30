<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request) 
    {
        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return response([
                'message' => ['Email not found'],
            ], 404);
        }

        if(!Hash::check($request->password, $user->password)) {
            return response([
               'message' => ['Password is wrong'],
            ], 404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();

        return response([
           'message' => 'Logout successful',
        ], 200);
    }
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name'          => 'required|string|max:255',
                'email'         => 'required|string|email|unique:users,email|max:255',
                'phone'         => 'required|string|unique:users,phone|max:20',
                'password'      => 'required|string|min:4',
                'jenis_kelamin' => 'required|in:L,P',
                'no_ktp'        => 'required|string|max:50',
                // 'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // jika ingin upload foto
            ]);

            $user = User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'password'      => Hash::make($request->password),
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_ktp'        => $request->no_ktp,
                // 'image'      => $request->file('image') ? $request->file('image')->store('users', 'public') : null,
                'role'       => 'user', // default, bisa diubah jika perlu
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response([
                'status'  => 'success',
                'message' => 'Registrasi berhasil',
                'user'    => $user,
                'token'   => $token,
            ], 201);
        } catch (\Exception $e) {
            return response([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateImage(Request $request) {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg'
            ]);

            // Ambil data user yang login
            $user = $request->user();
            // Mengecek ada gambar atau file di inputan atau form nya
            if ($request->hasFile('image')) {
                // cek apakah user punya data nama file gambar di database
                // Dicek dulu di file_exists apakah file itu benar ada di public_path atau di folder public
                if ($user->image && file_exists(public_path($user->image))) {
                    // unlink itu fungsi bawaan dari php untuk menghapus file dari server
                    // unlink itu sa,a kayak delete, jadi kita hapus file yang ada di server
                    unlink(public_path($user->image));
                }

                // ambil file yang diinput dari request
                $image = $request->file('image');
                // 
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // pindah dari lokasi sementara ke lokasi yang kita inginkan
                // dari temporary ke public_path atau ke public/images/users
                // public_path itu adalah folder public di dalam project kita
                // harus dipindahkan ke public_path atau folder public karena kan laravel baca file dari folder public
                $image->move(public_path('images/users'), $imageName);

                $user->image = 'images/users/' . $imageName;
                $user->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile photo update',
                    'data' => $user
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'No image uploaded'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'jenis_kelamin' => 'required|in:L,P',
            'no_ktp' => 'required|string|max:50',
            // tambahkan validasi lain jika perlu
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_ktp' => $request->no_ktp,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diupdate',
            'user' => $user
        ]);
    }
}

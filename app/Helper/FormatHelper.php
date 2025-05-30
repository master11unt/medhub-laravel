<?php

namespace App\Models\User;

use App\Models\User;
use Carbon\Carbon;

class FormatHelper {
    public static function formatResultAuth($user) {
        return [
            'id_user' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'phone' => $user->phone,
            'jenis_kelamin' => $user->jenis_kelamin,
            'no_ktp' => $user->no_ktp,
            'tanggal_daftar' => Carbon::parse($user->created_at)->translatedFormat('d F Y'),
            'updated_at' => Carbon::parse($user->updated_at)->translatedFormat('d F Y'),
        ];
    }

    public static function resultUser($id_user) {
        $user = User::where('id', $id_user)
        ->get()
        ->map(function ($user) {
            return FormatHelper::formatResultAuth($user);
        });
        return $user;
    }
}
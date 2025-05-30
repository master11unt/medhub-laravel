<?php

namespace App\Helper;

class MessageHelper {
    public static function error($status, $msg) {
        return response()->json([
            'status' => $status,
            'message' => $msg
        ]);
    }

    public static function resultAuth($status, $msg, $data, $responCode, $token) {
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'data' => $data,
            'token' => $token
        ], $responCode);
    }
}
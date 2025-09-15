<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success(array $data = [], string $message = '', int $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function fail(string $message, int $status = 400)
    {
        return response()->json([
            'status' => 'fail',
            'message' => $message,
        ], $status);
    }
}

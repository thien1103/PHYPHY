<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Trả về response thành công chuẩn API
     */
    protected function success(array|object $data = [], string $message = 'Success', int $code = 200): JsonResponse
    {
        return ApiResponse::success($data, $message, $code);
    }

    /**
     * Trả về response thất bại chuẩn API
     */
    protected function fail(string $message = 'Fail', int $code = 500, array $data = []): JsonResponse
    {
        return ApiResponse::fail($message, $code, $data);
    }

    /**
     * Lấy user hiện tại (nếu có)
     */
    protected function currentUser()
    {
        return auth()->user();
    }

    /**
     * Helper lấy request JSON data
     */
    protected function jsonRequest(Request $request): array
    {
        return $request->all();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Helpers\ApiResponse;
use Exception;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function login(LoginRequest $request)
    {
        try {
            $result = $this->authService->login($request->email, $request->password);

            return ApiResponse::success(
                $result,
                'Login successful'
            );
        } catch (Exception $e) {
            return ApiResponse::fail($e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function logout()
    {
        try {
            $this->authService->logout();
            return ApiResponse::success([], 'Logged out successfully');
        } catch (Exception $e) {
            return ApiResponse::fail($e->getMessage(), $e->getCode() ?: 500);
        }
    }
}

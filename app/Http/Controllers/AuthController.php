<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function login(Request $request)
    {
            $validated = $request->validate([
                'email'    => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            // Call service
            $result = $this->authService->login($validated['email'], $validated['password']);
            return $this->success($result, 'Login successful');
    }

    public function logout()
    {
        $this->authService->logout();
        return $this->success([], 'Logged out successfully');
    }
}

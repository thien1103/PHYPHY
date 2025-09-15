<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;
use Exception;

class AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function login(string $email, string $password): array
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user['password'])) {
            throw new Exception('Invalid credentials', 401);
        }

        // try {
        //     $token = JWTAuth::claims(['id' => $user['id']])->fromUser((object) $user);
        // }
        try {
            // 1️⃣ Tạo payload thủ công (phải gọi ->make() để build payload)
            $payload = JWTFactory::customClaims([
                'sub'   => $user['id'],   // subject (bắt buộc theo chuẩn JWT)
                'email' => $user['email'],
                'name'  => $user['name'],
                'iat'   => now()->timestamp, // issued at
                'exp'   => now()->addHours(2)->timestamp, // hết hạn sau 2h
            ])->make();

            // 2️⃣ Encode payload thành token
            $token = JWTAuth::encode($payload)->get();

        }
        catch (JWTException $e) {
            throw new Exception('Could not create token', 500);
        }

        return [
            'token' => $token,
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ]
        ];
    }

    public function logout(): void
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            throw new Exception('Failed to logout', 500);
        }
    }
}

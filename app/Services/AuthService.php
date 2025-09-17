<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;
use App\Models\User;

class AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function login(string $email, string $password): array
    {
        /** @var User|null $user */
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new Exception('Invalid credentials', 401);
        }

        try {
            // tạo JWT từ chính User model
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            throw new Exception('Could not create token', 500);
        }

        return [
            'token' => $token,
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
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

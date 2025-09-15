<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class UserRepository
{
    private array $users = [
        [
            "id" => 1,
            "name" => "Demo User",
            "email" => "demo@example.com",
            "password" => '$2y$12$mhSPjIFMfh85N64L23lw9OGq3Kjqk7gTdXRwyvMfFWUsDwt4Ejtxq', // 123456
        ],
        [
            "id" => 2,
            "name" => "Another User",
            "email" => "another@example.com",
            "password" => '$2y$12$lmcZ2/8O5lqlham9Kc3ui.kq1pQDPKnhfXwdrwJD.tb2kgLuyj7FW', // 654321
        ],
    ];

    public function findByEmail(string $email): ?array
    {
        return collect($this->users)->firstWhere('email', $email);
    }

    public function findById(int $id): ?array
    {
        return collect($this->users)->firstWhere('id', $id);
    }
}

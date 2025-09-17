<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Collection;

class UserService
{
    public function __construct(
        private readonly UserRepository $users
    ) {}

    public function getStaffs(): Collection
    {
        return $this->users->getStaffs();
    }
}

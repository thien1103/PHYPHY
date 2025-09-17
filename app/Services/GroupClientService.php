<?php

namespace App\Services;

use App\Repositories\GroupClientRepository;
use Illuminate\Support\Collection;

class GroupClientService
{
    public function __construct(
        private readonly GroupClientRepository $groupClients
    ) {}

    public function getByType(int $type): Collection
    {
        return $this->groupClients->getByType($type);
    }
}

<?php

namespace App\Repositories;

use App\Models\GroupClient;
use Illuminate\Support\Collection;

class GroupClientRepository
{
    public function getByType(int $type): Collection
    {
        return GroupClient::select('id', 'title')
            ->where('type', $type)
            ->get();
    }
}

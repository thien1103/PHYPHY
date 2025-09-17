<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    /**
     * Lấy danh sách staff
     */
    public function getStaffs(): Collection
    {
        // nếu muốn lọc role = staff thì thêm where
        return User::select('id', 'name')->get();
    }

    /**
     * Tìm user theo email
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Tìm user theo id
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }
}

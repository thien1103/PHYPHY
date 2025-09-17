<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {}

    public function staffs(): JsonResponse
    {
        $users = $this->userService->getStaffs();

        return $this->success($users->toArray(), 'Staffs retrieved successfully');
    }
}

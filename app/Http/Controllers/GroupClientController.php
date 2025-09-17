<?php

namespace App\Http\Controllers;

use App\Services\GroupClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupClientController extends Controller
{
    public function __construct(
        private readonly GroupClientService $groupClientService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'required|integer',
        ]);

        $groupClients = $this->groupClientService->getByType($validated['type']);

        return $this->success($groupClients->toArray(), 'Group clients retrieved successfully');
    }
}

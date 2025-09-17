<?php

namespace App\Http\Controllers;

use App\Services\ClientSenderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientSenderController extends Controller
{
	public function __construct(private readonly ClientSenderService $clientSenderService)
	{
	}

	public function store(Request $request): JsonResponse
	{
		$validated = $request->validate([
			'type'                     => ['required','integer','in:0,1'],
			'user_id'                  => ['required','integer'],
            'staff'                    => ['required','integer'],
			'client_data'              => ['required','array'],
			'client_data.fullname'     => ['nullable','string','max:255'],
			'client_data.phone'        => ['nullable','string','max:50'],
			'client_data.code'         => ['nullable','integer','in:1,2,3'],
			'client_data.group_client' => ['nullable','integer'],
			'client_data.email'        => ['nullable','string','max:255'],
			'client_data.code_client'  => ['nullable','string','max:255'],
			'client_data.tax_code'     => ['nullable','string','max:255'],
			'client_data.birtday'      => ['nullable','date'],
			'client_data.sex'          => ['nullable','string','max:50'],
			'client_data.address'      => ['nullable','string'],
			'client_data.tags'         => ['nullable','string'],
			'client_data.notes'        => ['nullable','string'],
		]);

		$client = $this->clientSenderService->create(
			$validated['user_id'],
			$validated['type'],
            $validated['staff'],
			$validated['client_data']
		);

		return $this->success($client->toArray(), 'Client sender created successfully', 201);
	}
}





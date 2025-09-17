<?php

namespace App\Repositories;

use App\Models\ClientSender;

class ClientSenderRepository
{
	public function create(array $attributes): ClientSender
	{
		return ClientSender::create($attributes);
	}

	public function updateCodeClient(ClientSender $client, string $code): ClientSender
	{
		$client->code_client = $code;
		$client->save();
		return $client->refresh();
	}
}





<?php

namespace App\Services;

use App\Repositories\ClientSenderRepository;
use App\Models\ClientSender;
use Illuminate\Support\Facades\DB;

class ClientSenderService
{
	public function __construct(private readonly ClientSenderRepository $clientSenders)
	{
	}

	public function create(int $userId, int $type, int $staffId, array $clientData): ClientSender
	{
		return DB::transaction(function () use ($userId, $type, $staffId, $clientData) {

			$hasCodeClient = isset($clientData['code_client']) && !empty($clientData['code_client']);
			$attributes    = array_merge($clientData, [
				'user_id' => $userId,
				'staff'   => $staffId,
				'type'    => $type,
			]);

			// Process and serialize tags data
			if (array_key_exists('tags', $attributes)) {
				$attributes['tags'] = $this->serializeTags($attributes['tags']);
			}

			if (!$hasCodeClient) {
				$count                     = ClientSender::count();
				$attributes['code_client'] = 'SP'.date('Y').date('m').$count;
			}

			return $this->clientSenders->create($attributes);
		});
	}

	/**
	 * Serialize tags data to PHP serialized format
	 */
	private function serializeTags($tags): string
	{
		if (empty($tags)) {
			return serialize([null]);
		}

		$tagsArray = is_array($tags)
			? $tags
			: explode(',', $tags);

		$tagsArray = array_filter(
			array_map('trim', $tagsArray),
			fn($tag) => !empty($tag)
		);


		return serialize(empty($tagsArray) ? [null] : array_values($tagsArray));
	}
}





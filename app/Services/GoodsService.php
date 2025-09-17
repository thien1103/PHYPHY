<?php

namespace App\Services;

use App\Models\Goods;
use App\Repositories\GoodsRepository;
use Illuminate\Support\Facades\DB;

class GoodsService
{
	public function __construct(private readonly GoodsRepository $goods)
	{
	}

	public function create(array $data): Goods
	{
		// Process and serialize image data
		if (array_key_exists('image', $data)) {
			$data['image'] = $this->serializeImage($data['image']);
		}

		return DB::transaction(fn () => $this->goods->create($data));
	}

	/**
	 * Serialize image data to PHP serialized format
	 */
	private function serializeImage($image): string
	{
		if (empty($image)) {
			return serialize([null]);
		}

		$images = is_array($image)
			? $image
			: explode(',', $image);

		$images = array_filter(
			array_map('trim', $images),
			fn($img) => !empty($img)
		);

		return serialize(empty($images) ? [null] : array_values($images));
	}
}


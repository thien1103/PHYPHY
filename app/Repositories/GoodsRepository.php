<?php

namespace App\Repositories;

use App\Models\Goods;

class GoodsRepository
{
	public function create(array $attributes): Goods
	{
		return Goods::create($attributes);
	}
}





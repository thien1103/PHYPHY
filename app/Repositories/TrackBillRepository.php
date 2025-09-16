<?php

namespace App\Repositories;

use App\Models\TrackBill;

class TrackBillRepository
{
	public function create(array $attributes): TrackBill
	{
		return TrackBill::create($attributes);
	}
}





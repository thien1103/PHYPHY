<?php

namespace App\Services;

use App\Repositories\TrackBillRepository;
use App\Models\TrackBill;
use Illuminate\Support\Facades\DB;

class TrackBillService
{
	public function __construct(private readonly TrackBillRepository $trackBills)
	{
	}

	public function create(array $data): TrackBill
	{
		return DB::transaction(fn () => $this->trackBills->create($data));
	}
}





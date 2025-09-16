<?php

namespace App\Http\Controllers;

use App\Services\TrackBillService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackBillController extends Controller
{
	public function __construct(private readonly TrackBillService $trackBillService)
	{
	}

	public function store(Request $request): JsonResponse
	{
		$validated = $request->validate([
			'client_sender'     => ['required','string','max:255'],
			'client_receiver'   => ['required','string','max:255'],
			'notes_receiver'    => ['nullable','string'],
			'notes_sender'      => ['nullable','string'],
			'id_hanghoa'        => ['required','string'],
			'price'             => ['required','string'],
			'discount'          => ['nullable','string'],
			'status'            => ['nullable','integer'],
			'ghichu_donhang'    => ['nullable','string'],
			'codebill'          => ['required','string','max:255'],
			'manager_warehouse' => ['required','integer','exists:tpl_warehouse_management,id'],
			'warehouse'         => ['required','integer','exists:tpl_warehouses,id'],
			'user_id'           => ['required','integer'],
			'staff'             => ['required','integer'],
			'created_at'        => ['nullable','date'],
			'tags'              => ['nullable','string'],
			'id_partner'        => ['nullable','string'],
		]);

		$trackBill = $this->trackBillService->create($validated);
		return $this->success($trackBill->toArray(), 'TrackBill created successfully', 201);
	}
}





<?php

namespace App\Http\Controllers;

use App\Services\GoodsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
	public function __construct(private readonly GoodsService $goodsService)
	{
	}

	public function store(Request $request): JsonResponse
	{
		$validated = $request->validate([
			'name'         => ['required','string','max:255'],
			'code'         => ['required','string','max:255'],
			'barcode'      => ['nullable','string','max:255'],
			'id_group'     => ['nullable','integer'],
			'amount'       => ['required','integer','min:0'],
			'uom'          => ['required','string','max:50'],
			'date_created' => ['nullable','date'],
			'image'        => ['nullable'],
			'notes'        => ['nullable','string'],
			'warehouse'    => ['required','integer'],
			'staff'        => ['required','integer'],
			'user_id'      => ['required','integer'],
		]);

		$goods = $this->goodsService->create($validated);

		return $this->success($goods->toArray(), 'Goods created successfully', 201);
	}
}



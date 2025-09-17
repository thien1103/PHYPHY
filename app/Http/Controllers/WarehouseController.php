<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\WarehouseManagement;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
    /**
     * Get all warehouses from tpl_warehouses
     */
    public function warehouses(): JsonResponse
    {
        $warehouses = Warehouse::select('id', 'title')->get()->toArray();

        return $this->success($warehouses, 'Warehouses retrieved successfully');
    }

    /**
     * Get all warehouse management from tpl_warehouse_management
     */
    public function warehouseManagement(): JsonResponse
    {
        $warehouseManagement = WarehouseManagement::select('id', 'title')->get()->toArray();

        return $this->success($warehouseManagement, 'Warehouse management retrieved successfully');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseManagement extends Model
{
    protected $table = 'tpl_warehouse_management';

    protected $fillable = ['title'];

    // Disable timestamps if not needed
    public $timestamps = false;
}

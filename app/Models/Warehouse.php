<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'tpl_warehouses';

    protected $fillable = ['title'];

    // Disable timestamps if not needed
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
	use HasFactory;

	protected $table = 'tpl_goods';

	protected $fillable = [
		'name',
		'code',
		'barcode',
		'id_group',
		'amount',
		'uom',
		'date_created',
		'image',
		'notes',
		'warehouse',
		'staff',
		'user_id',
	];

	protected $casts = [
		'id_group'     => 'integer',
		'amount'       => 'integer',
		'warehouse'    => 'integer',
		'staff'        => 'integer',
		'user_id'      => 'integer',
		'date_created' => 'datetime',
		'image'        => 'string',
	];
}





<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackBill extends Model
{
	use HasFactory;

	protected $table = 'tpl_track_bills';

	protected $fillable = [
		'client_sender',
		'client_receiver',
		'note_receiver',
		'note_sender',
		'user_id',
		'id_hanghoa',
		'price',
		'discount',
		'status',
		'ghichu_donhang',
		'codebill',
		'manager_warehouse',
		'warehouse',
		'staff',
		'created_date',
		'tags',
		'id_partner',
	];

	protected $casts = [
		'price'             => 'string',
		'discount'          => 'string',
		'created_date'      => 'datetime',
		'tags'              => 'string',
		'warehouse'         => 'integer',
		'manager_warehouse' => 'integer',
		'staff'             => 'integer',
		'status'            => 'integer',
		'user_id'           => 'integer',
		'id_partner'        => 'string',
	];
}





<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSender extends Model
{
	use HasFactory;

	protected $table = 'tpl_client_senders';

	protected $fillable = [
		'user_id',
        'staff',
		'type',
		'fullname',
		'phone',
		'code',
		'group_client',
		'email',
		'code_client',
		'tax_code',
		'birtday',
		'sex',
		'address',
		'tags',
		'notes',
	];

	protected $casts = [
		'user_id'      => 'integer',
        'staff'        => 'integer',
		'type'         => 'integer',
		'code'         => 'integer',
		'group_client' => 'integer',
		'birtday'      => 'date',
	];
}










<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupClient extends Model
{
    protected $table = 'tpl_group_clients';

    protected $fillable = ['title', 'type'];

    // Disable timestamps if not needed
    public $timestamps = false;
}

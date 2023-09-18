<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerPresence extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'total_hours',
		'in_office_hours',
		'presence_status',
		'date',
	];
}

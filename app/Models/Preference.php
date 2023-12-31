<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
	use HasFactory;

	protected $fillable = [
		'key',
		'value',
	];

	public static function get($key)
	{
		$preference = Preference::where('key', $key)->first();
		if ($preference) {
			return $preference->value;
		}
		return null;
	}
}
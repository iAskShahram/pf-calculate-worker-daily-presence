<?php

namespace App\Services;

use \App\Models\Preference;

class PreferenceService
{
	public static function getPreferences()
	{
		$preferences = Preference::all();
		return $preferences;
	}

	public static function getPreferenceByKey($key)
	{
		$preference = Preference::get($key);
		return $preference;
	}

	public static function addPreference($key, $value)
	{
		$preference = new Preference();
		$preference->key = $key;
		$preference->value = $value;
		$preference->save();
		return $preference;
	}

	public static function updatePreference($key, $value)
	{
		$preference = Preference::where('key', $key)->first();
		$preference->value = $value;
		$preference->save();
		return $preference;
	}
}
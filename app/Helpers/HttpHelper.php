<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class HttpHelper
{
	public static function get($url)
	{
		$response = Http::get($url);
		if ($response->failed()) {
			return false;
		}
		return $response->json();
	}
}

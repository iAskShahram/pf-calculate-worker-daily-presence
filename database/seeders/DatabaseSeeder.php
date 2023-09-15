<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Office;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$OfficeIPs = [
			[
				"ip" => "233.243.435.6",
				"name" => "Office 1"
			],
			[
				"ip" => "174.246.324.7",
				"name" => "Office 2"
			],
			[
				"ip" => "165.345.243.251",
				"name" => "Office 3"
			],
			[
				"ip" => "143.432.234.11",
				"name" => "Office 4"
			]
		];
		// add these offices to the database
		foreach ($OfficeIPs as $OfficeIP) {
			$office = new Office();
			$office->ip = $OfficeIP['ip'];
			$office->name = $OfficeIP['name'];
			$office->save();
		}
	}
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Office;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$OfficeIPs = [
			['name' => 'Office A', 'ip' => '192.168.1.100'],
			['name' => 'Office B', 'ip' => '10.0.0.1'],
			['name' => 'Office C', 'ip' => '172.16.0.10'],
			['name' => 'Office D', 'ip' => '192.168.2.50'],
			['name' => 'Office E', 'ip' => '10.1.1.100'],
			['name' => 'Office F', 'ip' => '172.17.0.5'],
			['name' => 'Office G', 'ip' => '192.168.3.25'],
			['name' => 'Office H', 'ip' => '10.2.2.200'],
			['name' => 'Office I', 'ip' => '172.18.0.15'],
			['name' => 'Office J', 'ip' => '192.168.4.75']
		];
		// add these offices to the database
		foreach ($OfficeIPs as $OfficeIP) {
			$office = new Office();
			$office->name = $OfficeIP['name'];
			$office->ip = $OfficeIP['ip'];
			$office->save();
		}

		$preference = new \App\Models\Preference();
		$preference->key = 'worker_daily_presence_uri';
		$preference->value = 'backend.grabdata.org/api/pf';
		$preference->save();
	}
}

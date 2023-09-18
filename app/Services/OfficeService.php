<?php

namespace App\Services;

use \App\Models\Office;

class OfficeService
{
	public static function getOffices()
	{
		$offices = Office::all();
		return $offices;
	}

	public static function getAllOfficeIps()
	{
		$offices = Office::all();
		$ips = [];
		foreach ($offices as $office) {
			$ips[] = $office->ip;
		}
		return $ips;
	}

	public static function getAllOfficeNames()
	{
		$offices = Office::all();
		$names = [];
		foreach ($offices as $office) {
			$names[] = $office->name;
		}
		return $names;
	}

	public static function getOfficeById($id)
	{
		$office = Office::find($id);
		return $office;
	}

	public static function addOffice($name, $ip)
	{
		$office = new Office();
		$office->name = $name;
		$office->ip = $ip;
		$office->save();
		return $office;
	}

	public static function updateOffice($id, $name, $ip)
	{
		$office = Office::find($id);
		$office->name = $name;
		$office->ip = $ip;
		$office->save();
		return $office;
	}

	public static function deleteOfficeById($id)
	{
		$office = Office::find($id);
		$office->delete();
		return $office;
	}
}

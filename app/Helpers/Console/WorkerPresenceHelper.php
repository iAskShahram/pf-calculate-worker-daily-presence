<?php

namespace App\Helpers\Console;

use App\Helpers\HttpHelper;
use App\Services\OfficeService;
use App\Services\PreferenceService;
use Illuminate\Support\Facades\Validator;

class WorkerPresenceHelper
{
	// public static function validateWorkerPresence($data)
	// {
	// 	$rules = [
	// 		'user_id' => 'required',
	// 		'total_hours' => 'required',
	// 		'in_office_hours' => 'required',
	// 		'presence_status' => 'required',
	// 		'date' => 'required',
	// 	];

	// 	$validator = Validator::make($data, $rules);
	// 	if ($validator->fails()) {
	// 		return $validator->errors();
	// 	}
	// 	return true;
	// }

	public static function validateWorkerPresences($data)
	{
		$rules = [
			'*user_id' => 'required',
			'*total_hours' => 'required',
			'*in_office_hours' => 'required',
			'*presence_status' => 'required',
			'*date' => 'required',
		];

		// $data is the list of worker presences
		$validator = Validator::make($data, $rules);
		if ($validator->fails()) {
			return $validator->errors();
		}
		return true;
	}

	public static function prerequisite()
	{
		$uri = PreferenceService::getPreferenceByKey('worker_daily_presence_uri');
		if (!$uri) {
			return 'worker_daily_presence_uri not found';
		}


		$attendence = HttpHelper::get($uri);
		if (!$attendence) {
			return 'unable to get worker daily presence';
		}
		$attendence = $attendence['data'];

		$office_ips = OfficeService::getAllOfficeIps();
		if (!$office_ips) {
			return 'unable to get office ips';
		}

		$data['attendence'] = $attendence;
		$data['office_ips'] = $office_ips;

		return $data;
	}

	public static function getPresenceStatus($total_in_office_hours)
	{
		$presence_status = 'ABSENT';

		if ($total_in_office_hours > 5) {
			$presence_status = 'PRESENT';
		} else if ($total_in_office_hours > 3) {
			$presence_status = 'HALFDAY';
		}

		return $presence_status;
	}
}
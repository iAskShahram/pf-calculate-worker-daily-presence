<?php

namespace App\Services;

use \App\Models\WorkerPresence;
use \App\Helpers\Console\WorkerPresenceHelper;

class WorkerPresenceService
{
	public static function getWorkerPresences()
	{
		$workerPresences = WorkerPresence::all();
		return $workerPresences;
	}

	public static function getWorkerPresenceById($id)
	{
		$workerPresence = WorkerPresence::find($id);
		return $workerPresence;
	}

	public static function createWorkerPresences($data)
	{
		$errors = WorkerPresenceHelper::validateWorkerPresences($data);
		if (is_array($errors)) {
			return $errors;
		}
		$workerPresences = WorkerPresence::insert($data);
		return $workerPresences;
	}
}

<?php

namespace App\Console\Commands;

use App\Helpers\Console\WorkerPresenceHelper;
use Illuminate\Console\Command;
use App\Helpers\HttpHelper;
use App\Services\OfficeService;
use App\Services\PreferenceService;
use App\Services\WorkerPresenceService;
use DateTime;

class CalculateWorkerDailyPresence extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'hr:calculatedailypresence';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Calculate worker presence and update the database';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$this->info('Calculating worker daily presence...');

		/**
		 * @return array|string
		 * 
		 * @return string error message
		 * @return array ['attendence' => $attendence, 'office_ips' => $office_ips]
		 */
		$data = WorkerPresenceHelper::prerequisite();
		if (is_string($data)) {
			$this->error($data);
			return Command::FAILURE;
		}

		$attendence = $data['attendence'];
		$office_ips = $data['office_ips'];

		$attendence = collect($attendence);
		$attendence = $attendence->groupBy('user_id');

		$worker_presences = [];


		foreach ($attendence as $worker) {
			$total_working_seconds = 0;
			$total_in_office_seconds = 0;
			$user_id = $worker[0]['user_id'];
			$working_seconds = 0;


			// calculate total working hours and total in office hours
			foreach ($worker as $worker_attendance) {
				$checked_in_at = strtotime($worker_attendance['checked_in_at']);
				$checked_out_at = strtotime($worker_attendance['checked_out_at']);
				$working_seconds = $checked_out_at - $checked_in_at;
				if (in_array($worker_attendance['ip_address'], $office_ips)) {
					$total_in_office_seconds += $working_seconds;
				}
				$total_working_seconds += $working_seconds;
			}

			// convert seconds to hours
			$total_working_hours = $total_working_seconds / (60 * 60);
			$total_in_office_hours = $total_in_office_seconds / (60 * 60);

			$presence_status = WorkerPresenceHelper::getPresenceStatus($total_in_office_hours);

			array_push($worker_presences, [
				'user_id' => $user_id,
				'total_hours' => $total_working_hours,
				'in_office_hours' => $total_in_office_hours,
				'presence_status' => $presence_status,
				'date' => now(),
			]);
		}

		WorkerPresenceService::createWorkerPresences($worker_presences);

		$this->info('Worker daily presence calculated successfully');
		$this->info('Records inserted: ' . count($worker_presences));
		return Command::SUCCESS;
	}
}

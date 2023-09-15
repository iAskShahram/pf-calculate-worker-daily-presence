<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
	protected $description = 'Calculate worker daily presence';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		return Command::SUCCESS;
	}
}

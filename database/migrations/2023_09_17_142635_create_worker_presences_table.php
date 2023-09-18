<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('worker_presences', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->float('total_hours');
			$table->float('in_office_hours');
			$table->enum('presence_status', ['PRESENT', 'HALFDAY', 'ABSENT']);
			$table->dateTime('date');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('worker_presences');
	}
};

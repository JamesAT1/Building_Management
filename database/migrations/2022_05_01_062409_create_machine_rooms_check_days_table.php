<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineRoomsCheckDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_rooms_check_days', function (Blueprint $table) {
            $table->integer('machine_rooms_check_day_id')->primary();
            $table->integer('machine_room_id');
            $table->string('machine_rooms_check_day_status'); //0 unchecked 1 checked success 2 Problems that can be solved 3 problem machine
            $table->string('machine_rooms_check_day_description');
            $table->string('shift_worker_time');
            $table->string('machine_room_problem');
            $table->string('img_for_checked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machine_rooms_check_days');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_rooms', function (Blueprint $table) {
            $table->integer('machine_room_id')->primary();
            $table->string('machine_room_name');
            $table->string('machine_room_number');
            $table->integer('machine_room_level');
            $table->string('machine_room_detail');

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
        Schema::dropIfExists('machine_rooms');
    }
}

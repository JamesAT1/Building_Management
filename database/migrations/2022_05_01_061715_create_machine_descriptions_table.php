<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_descriptions', function (Blueprint $table) {
            $table->integer('machine_description_id')->primary();
            $table->integer('machine_rooms_check_day_id');
            $table->string('machine_description_name');
            $table->string('machine_description_image');
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
        Schema::dropIfExists('machine_descriptions');
    }
}

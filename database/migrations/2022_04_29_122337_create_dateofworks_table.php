<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateofworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dateofworks', function (Blueprint $table) {
            $table->integer('datework_id')->primary();
            $table->integer('user_id');
            $table->dateTime('date_start_work');
            $table->dateTime('date_off_work');
            $table->string('datework_check');
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
        Schema::dropIfExists('dateofworks');
    }
}

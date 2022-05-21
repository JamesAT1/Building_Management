<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListOfRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_of_repairs', function (Blueprint $table) {
            $table->integer('list_repair_id');
            $table->dateTime('date_of_report');
            $table->dateTime('date_for_update');
            $table->string('list_report');
            $table->string('status_repair');
            $table->string('notifier');
            $table->string('editor');
            $table->string('operator');
            $table->string('description');
            $table->string('approve_report');
            $table->boolean('bookmark_checked');
            $table->string('processing_date');
            $table->string('new_update_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_of_repairs');
    }
}

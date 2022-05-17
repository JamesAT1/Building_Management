<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {

            $table->integer('user_id')->primary();
            $table->string('user_name');
            $table->string('user_pass');
            $table->string('user_firstname');
            $table->string('user_lastname');
            $table->dateTime('user_begindatetowork');
            $table->string('user_img');
            $table->string('user_contrack');
            $table->dateTime('user_birth');
            $table->string('user_nickname');
            $table->integer('user_rule_status');
            $table->integer('user_sick_leave');
            $table->integer('user_personal_leave');
            $table->integer('user_vacation_leave');

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
        Schema::dropIfExists('user_accounts');
    }
}

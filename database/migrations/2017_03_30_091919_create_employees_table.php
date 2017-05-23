<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('post');
            $table->string('address');
            $table->date('dob');
            $table->text('social')->nullable();
            $table->string('designation');
            $table->string('working');
            $table->string('holiday');
            $table->string('hospital');
            $table->string('schedule');
            //$table->integer('schedule_id')->unsigned(); it mast be in shedule employee_id
            //$table->foreign('schedule_id')->references('id')->on('schedules');
            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->integer('salary');
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
        Schema::dropIfExists('employees');
    }
}

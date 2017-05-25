<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_training', function (Blueprint $table) {

            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('training_id');
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
            $table->primary(['employee_id', 'training_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_training');
    }
}

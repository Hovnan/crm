<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriberTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_training', function (Blueprint $table) {

            $table->unsignedInteger('subscriber_id');
            $table->unsignedInteger('training_id');
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
            $table->primary(['subscriber_id', 'training_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriber_training');
    }
}

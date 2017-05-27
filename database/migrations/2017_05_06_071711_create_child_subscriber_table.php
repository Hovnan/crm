<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_subscriber', function (Blueprint $table) {

            $table->increments('id');

            $table->string('number', 10);

            $table->integer('child_id')->unsigned()->index();
            $table->foreign('child_id')->references('id')->on('childs')->onDelete('cascade');

            $table->integer('subscriber_id')->unsigned()->index();
            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('cascade');

            $table->string('remainder', 3)->nullable();
            $table->string('paid', 10)->nullable();

            $table->date('valid')->nullable();
            $table->date('last_visit')->nullable();
            
            $table->timestamps();

            //$table->primary(['child_id', 'subscriber_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_subscriber');
    }
}

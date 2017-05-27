<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['0', '1'])->default('0');
            $table->string('name');
            $table->string('price');
            $table->string('visits', 5)->nullable();
            $table->string('validity', 5)->nullable();
            $table->string('freeze', 5)->nullable();
            $table->integer('branch_id')->unsigned();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
}

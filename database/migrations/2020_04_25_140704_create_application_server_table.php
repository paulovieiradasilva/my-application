<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_server', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applications')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('server_id');
            $table->foreign('server_id')->references('id')->on('servers')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('application_server');
    }
}

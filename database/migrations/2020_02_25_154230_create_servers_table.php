<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('ip')->nullable();
            $table->string('os')->nullable();
            $table->string('version_os')->nullable();
            $table->enum('type', ['Aplicação', 'Banco de Dados'], 100)->nullable();

            $table->unsignedBigInteger('environment_id');
            $table->foreign('environment_id')->references('id')->on('environments');

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
        Schema::dropIfExists('servers');
    }
}

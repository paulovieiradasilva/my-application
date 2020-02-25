<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('start', ['automatic', 'manual'])->nullable();
            $table->string('platform')->nullable();
            $table->enum('type', ['web', 'executable'])->nullable();
            $table->string('directory_app')->nullable();
            $table->string('uri_internet')->nullable();
            $table->string('uri_intranet')->nullable();

            $table->unsignedBigInteger('server_id');
            $table->foreign('server_id')->references('id')->on('servers');

            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');

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
        Schema::dropIfExists('applications');
    }
}

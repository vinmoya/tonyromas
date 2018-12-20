<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivateCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activate_code', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('code_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->date('activation_date');
            $table->string('command_activation');

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
        Schema::dropIfExists('activate_code');
    }
}

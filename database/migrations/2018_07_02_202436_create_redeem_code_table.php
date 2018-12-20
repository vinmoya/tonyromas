<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_code', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('code_id');
            $table->unsignedInteger('user_id');
            $table->date('redemption_date');
            $table->string('exchange_command');

            $table->foreign('code_id')->references('id')->on('codes')
                        ->onUpdate('cascade')->onDlete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                        ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('redeem_code');
    }
}

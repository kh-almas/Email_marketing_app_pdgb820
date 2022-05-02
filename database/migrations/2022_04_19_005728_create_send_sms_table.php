<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_sms', function (Blueprint $table) {
            $table->id();
            $table->string('accountRef')->nullable();
            $table->string('clientRef')->nullable();
            $table->string('messageId');
            $table->string('messagePrice')->nullable();
            $table->string('network')->nullable();
            $table->string('remainingBalance')->nullable();
            $table->string('status')->nullable();
            $table->string('to');
            $table->string('from');
            $table->string('message');
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
        Schema::dropIfExists('send_sms');
    }
};

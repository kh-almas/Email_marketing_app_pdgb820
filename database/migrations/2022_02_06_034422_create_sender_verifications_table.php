<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenderVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sender_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('sendgrid_id');
            $table->string('nickname');
            $table->string('from_email');
            $table->string('from_name');
            $table->string('reply_to');
            $table->string('reply_to_name');
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('state')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('zip');
            $table->boolean('verified');
            $table->boolean('locked');
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
        Schema::dropIfExists('sender_verifications');
    }
}

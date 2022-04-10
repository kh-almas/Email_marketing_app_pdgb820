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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suppression_group_id');
            $table->unsignedBigInteger('sender_id');
            $table->string('sendgrid_id');
            $table->string('title');
            $table->string('subject');
            $table->integer('segment_ids');
            $table->string('categories');
            $table->string('custom_unsubscribe_url');
            $table->string('ip_pool');
            $table->string('html_content');
            $table->string('plain_content');
            $table->string('editor');
            $table->timestamps();
            $table->foreign('suppression_group_id')->references('id')->on('unsubscribe_groups');
            $table->foreign('sender_id')->references('id')->on('sender_verifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};

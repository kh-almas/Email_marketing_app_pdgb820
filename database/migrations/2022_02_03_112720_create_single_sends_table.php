<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleSendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('single_sends', function (Blueprint $table) {
            $table->id();
            $table->string('sendgrid_id');
            $table->string('name');
            $table->string('status')->nullable();
            $table->string('categories')->nullable();
            $table->string('segment_ids')->nullable();
            $table->boolean('send_all')->nullable();
            $table->string('subject');
            $table->string('suppression_group_id');
            $table->string('sender_id');
            $table->longText('html_content');
            $table->longText('plain_content')->nullable();
            $table->boolean('generate_plain_content')->nullable();
            $table->string('custom_unsubscribe_url')->nullable();
            $table->string('ip_pool')->nullable();
            $table->string('editor')->nullable();
            $table->boolean('is_send')->nullable();
            $table->dateTime('send_at')->nullable();
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
        Schema::dropIfExists('single_sends');
    }
}

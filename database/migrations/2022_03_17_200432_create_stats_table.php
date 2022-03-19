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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('date')->unique();
            $table->integer('blocks');
            $table->integer('bounce_drops');
            $table->integer('bounces');
            $table->integer('deferred');
            $table->integer('delivered');
            $table->integer('invalid_emails');
            $table->integer('processed');
            $table->integer('requests');
            $table->integer('spam_report_drops');
            $table->integer('spam_reports');
            $table->integer('unsubscribe_drops');
            $table->integer('unsubscribes');
            $table->integer('clicks');
            $table->integer('unique_clicks');
            $table->integer('opens');
            $table->integer('unique_opens');
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
        Schema::dropIfExists('stats');
    }
};

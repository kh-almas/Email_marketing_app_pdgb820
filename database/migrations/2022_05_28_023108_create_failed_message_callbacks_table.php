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
        Schema::create('failed_message_callbacks', function (Blueprint $table) {
            $table->id();
            $table->integer('try')->default(0);
            $table->string('include_subaccounts')->nullable();
            $table->string('account_id')->nullable();
            $table->string('message_id')->nullable();
            $table->string('account_ref')->nullable();
            $table->string('client_ref')->nullable();
            $table->string('direction')->nullable();
            $table->string('from');
            $table->string('to');
            $table->string('forced_from')->nullable();
            $table->string('message_body');
            $table->string('concatenated')->nullable();
            $table->string('network')->nullable();
            $table->string('network_name')->nullable();
            $table->string('country')->nullable();
            $table->string('country_name')->nullable();
            $table->string('date_received');
            $table->string('date_finalized');
            $table->string('latency')->nullable();
            $table->string('status');
            $table->string('error_code')->nullable();
            $table->string('error_code_description')->nullable();
            $table->string('currency')->nullable();
            $table->string('total_price')->nullable();
            $table->string('m_id')->nullable();
            $table->string('dcs')->nullable();
            $table->string('validity_period')->nullable();
            $table->string('ip_address')->nullable();
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
        Schema::dropIfExists('failed_message_callbacks');
    }
};

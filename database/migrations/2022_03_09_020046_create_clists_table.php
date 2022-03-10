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
        Schema::create('clists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sendgrid_id')->nullable();
            $table->string('sendgrid_contact_count')->nullable();
            $table->string('sendgrid_metadata')->nullable();
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
        Schema::dropIfExists('clists');
    }
};

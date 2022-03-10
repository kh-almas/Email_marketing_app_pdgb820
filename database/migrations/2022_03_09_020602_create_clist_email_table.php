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
        Schema::create('clist_email', function (Blueprint $table) {
//            $table->integer('clist_id');
//            $table->integer('email_id');
            $table->foreignId('clist_id')->constrained();
            $table->foreignId('email_id')->constrained();
//            $table->id();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clist_email');
    }
};

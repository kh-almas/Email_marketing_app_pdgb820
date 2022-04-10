<?php

use App\Models\PhoneNumber;
use App\Models\PList;
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
        Schema::create('list_number', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
            $table->foreignIdFor(PList::class);
            $table->foreignIdFor(PhoneNumber::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_number');
    }
};

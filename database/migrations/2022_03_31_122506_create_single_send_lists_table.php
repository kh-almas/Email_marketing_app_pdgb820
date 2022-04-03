<?php

use App\Models\Clist;
use App\Models\SingleSend;
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
        Schema::create('single_send_lists', function (Blueprint $table) {
            $table->foreignIdFor(SingleSend::class)->constrained();
            $table->foreignIdFor(Clist::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('single_send_lists');
    }
};

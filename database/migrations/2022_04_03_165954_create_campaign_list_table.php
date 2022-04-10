<?php

use App\Models\Campaign;
use App\Models\Clist;
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
        Schema::create('campaign_list', function (Blueprint $table) {
            $table->foreignIdFor(Campaign::class)->constrained();
            $table->foreignIdFor(Clist::class)->constrained();
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
        Schema::dropIfExists('campaign_list');
    }
};

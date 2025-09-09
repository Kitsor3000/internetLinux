<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamePeriodsTable extends Migration
{
    public function up()
    {
        Schema::create('game_periods', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_weeks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_periods');
    }
}

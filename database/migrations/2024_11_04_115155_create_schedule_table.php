<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id');
            $table->date('date');
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('type');
            $table->string('booking_type');
            $table->boolean('is_booked');
            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('game_periods')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};

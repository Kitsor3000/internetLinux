<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('weekly_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id');
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('booking_type');
            $table->decimal('fixed_price', 8, 2);
            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('game_periods')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weekly_bookings');
    }
};

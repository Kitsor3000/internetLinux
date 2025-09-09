<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('booking_fact', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('participant_id');
            $table->date('actual_date');
            $table->unsignedBigInteger('instead_of_plan_id')->nullable();
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedule')->onDelete('cascade');
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->foreign('instead_of_plan_id')->references('id')->on('booking_plan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_fact');
    }
};

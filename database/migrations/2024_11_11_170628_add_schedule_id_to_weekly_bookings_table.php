<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('weekly_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('schedule_id')->after('participant_id');
            $table->foreign('schedule_id')->references('id')->on('schedule')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('weekly_bookings', function (Blueprint $table) {
            $table->dropForeign(['schedule_id']);
            $table->dropColumn('schedule_id');
        });
    }
};

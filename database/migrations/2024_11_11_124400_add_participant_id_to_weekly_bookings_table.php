<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('weekly_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('participant_id')->after('period_id');
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('weekly_bookings', function (Blueprint $table) {
            $table->dropForeign(['participant_id']);
            $table->dropColumn('participant_id');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->string('telegram_id')->nullable()->default(null)->after('phone');
            $table->boolean('telegram_allowed')->nullable()->default(false)->after('telegram_id');
            $table->boolean('telegram_usage')->nullable()->default(false)->after('telegram_allowed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->removeColumn('telegram_id');
            $table->removeColumn('telegram_allowed');
            $table->removeColumn('telegram_usage');
        });
    }
};

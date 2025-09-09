<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('telegram_user_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('telegram_user_id');
            $table->unsignedBigInteger('voting_id');
            $table->unsignedBigInteger('option_id');
            $table->timestamps();

            $table->foreign('telegram_user_id')->references('id')->on('telegram_users')->onDelete('cascade');
            $table->foreign('voting_id')->references('id')->on('votings')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('voting_options')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telegram_user_votes');
    }
};

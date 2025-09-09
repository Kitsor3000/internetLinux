<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('voting_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voting_id');
            $table->string('option_text');
            $table->timestamps();

            $table->foreign('voting_id')->references('id')->on('votings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voting_options');
    }
};

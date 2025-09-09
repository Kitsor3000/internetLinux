<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alias_id');
            $table->unsignedBigInteger('participant_id');
            $table->date('date');
            $table->decimal('amount', 8, 2);
            $table->string('purpose');
            $table->timestamps();

            $table->foreign('alias_id')->references('id')->on('aliases')->onDelete('cascade');
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

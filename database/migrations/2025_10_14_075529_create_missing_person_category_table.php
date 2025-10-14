<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missing_person_category', function (Blueprint $table) {
            $table->foreignId('missing_person_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->primary(['missing_person_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missing_person_category');
    }
};

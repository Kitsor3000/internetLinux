<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missing_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('last_location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->integer('age');
            $table->string('gender'); // Змінили enum на string
            $table->text('description');
            $table->text('special_marks')->nullable();
            $table->string('photo_path')->nullable();
            $table->date('disappeared_at');
            $table->string('status')->default('missing'); // Змінили enum на string
            $table->text('contact_info');
            $table->boolean('is_urgent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missing_people');
    }
};

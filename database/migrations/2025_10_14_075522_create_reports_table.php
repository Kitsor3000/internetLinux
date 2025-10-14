<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('missing_person_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('reporter_name');
            $table->string('reporter_phone');
            $table->text('sighting_details');
            $table->foreignId('sighting_location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->timestamp('sighting_time');
            $table->string('status')->default('new'); // Змінили enum на string
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

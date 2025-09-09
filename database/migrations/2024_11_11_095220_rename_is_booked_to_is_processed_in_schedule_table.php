<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIsBookedToIsProcessedInScheduleTable extends Migration
{
    public function up()
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->renameColumn('is_booked', 'is_processed');
        });
    }

    public function down()
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->renameColumn('is_processed', 'is_booked');
        });
    }
}

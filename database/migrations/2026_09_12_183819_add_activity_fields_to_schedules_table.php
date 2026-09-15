<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('activity_type')
                ->default('course')
                ->after('slot_id');

            $table->string('special_note')
                ->nullable()
                ->after('activity_type');
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn([
                'activity_type',
                'special_note',
            ]);
        });
    }
};
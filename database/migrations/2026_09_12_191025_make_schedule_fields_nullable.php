<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable()->change();
            $table->foreignId('professor_id')->nullable()->change();
            $table->foreignId('room_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable(false)->change();
            $table->foreignId('professor_id')->nullable(false)->change();
            $table->foreignId('room_id')->nullable(false)->change();
        });
    }
};
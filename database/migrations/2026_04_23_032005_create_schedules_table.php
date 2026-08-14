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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            // Core relationships
            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('professor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('room_id')
                ->constrained('classrooms')
                ->cascadeOnDelete();

            // Time structure (flexible system)
            $table->string('day_of_week'); // Mon, Tue, Wed...

            $table->time('start_time');
            $table->time('end_time');

            // Academic term
            $table->string('semester');

            // Approval workflow
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Optional note (VERY useful in real systems)
            $table->text('note')->nullable();

            $table->timestamps();

            // Indexes for performance
            //what is indexes doing here? it makes queries faster when we search by these columns.
            //why? because we will often query schedules by professor, room, day, and course.
            //it like a search engine for schedules, we want it to be fast.
            $table->index(['professor_id', 'day_of_week']);
            $table->index(['room_id', 'day_of_week']);
            $table->index(['course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
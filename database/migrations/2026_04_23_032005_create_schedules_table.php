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

            // Primary key
            $table->id();

            // Schedule grouping
            $table->uuid('schedule_group_id')
                ->nullable()
                ->index();

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

            // Time structure
            $table->string('day_of_week');

            $table->foreignId('slot_id')
                ->constrained('time_slots')
                ->cascadeOnDelete();

            // Academic information
            $table->string('semester');

            $table->string('academic_year', 20);

            $table->unsignedInteger('promotion');

            // Academic dates
            $table->date('starting_date')->nullable();

            $table->date('finished_date')->nullable();

            $table->date('midterm_exam_start')->nullable();

            $table->date('midterm_exam_end')->nullable();

            $table->date('final_exam_start')->nullable();

            $table->date('final_exam_end')->nullable();

            // Approval workflow
            $table->enum('status', [
                'draft',
                'pending',
                'approved',
                'rejected',
                'published'
            ])->default('draft');

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Optional note
            $table->text('note')->nullable();

            $table->timestamps();

            // Indexes for common schedule queries
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

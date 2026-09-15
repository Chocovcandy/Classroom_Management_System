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
        Schema::create('project_submission_grades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_submission_id')
                ->constrained('project_submissions')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('score', 8, 2)->nullable();

            $table->text('feedback')->nullable();

            $table->timestamp('graded_at')->nullable();

            $table->timestamps();

            // One grade per student for one team submission

            $table->unique(
                ['project_submission_id', 'student_id'],
                'submission_student_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_submission_grades');
    }
};

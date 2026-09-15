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
        Schema::create('project_submissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // NULL for Individual Projects
            // Team ID for Team Projects
            $table->foreignId('project_group_id')
                ->nullable()
                ->constrained('project_groups')
                ->cascadeOnDelete();

            $table->timestamp('submitted_at')->nullable();

            // Used for Individual Projects
            $table->decimal('score', 8, 2)->nullable();

            $table->text('feedback')->nullable();

            $table->timestamp('graded_at')->nullable();

            $table->string('status')->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_submissions');
    }
};
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // The class group this project belongs to
            $table->foreignId('class_group_id')
                ->constrained('class_groups')
                ->cascadeOnDelete();

            // Topic this project belongs to
            $table->foreignId('topic_id')
                ->nullable()
                ->constrained('topics')
                ->nullOnDelete();

            // Professor who created the project
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('description')->nullable();

            $table->date('due_date')->nullable();

            $table->time('due_time')->nullable();

            $table->decimal('points', 8, 2)->nullable();

            // individual or team
            $table->string('project_type')->default('individual');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
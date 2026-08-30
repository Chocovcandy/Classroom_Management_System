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
        Schema::create('exams', function (Blueprint $table) {

            $table->id();

            $table->foreignId('class_group_id')
                ->constrained('class_groups')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('topic_id')
                ->nullable()
                ->constrained('topics')
                ->nullOnDelete();

            $table->string('title');

            $table->text('description')
                ->nullable();

            $table->date('due_date')
                ->nullable();

            $table->time('due_time')
                ->nullable();

            $table->decimal('points', 8, 2)
                ->nullable();

            $table->string('attachment')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
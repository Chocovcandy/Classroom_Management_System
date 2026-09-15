<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_groups', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('group_name');
            $table->unsignedInteger('group_number');

            $table->timestamps();

            $table->unique([
                'project_id',
                'group_number',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_groups');
    }
};
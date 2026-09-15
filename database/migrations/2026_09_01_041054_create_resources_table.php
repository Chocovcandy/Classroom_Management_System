<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();

            $table->string('resourceable_type');
            $table->unsignedBigInteger('resourceable_id');

            $table->string('title');

            $table->string('type');

            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();

            $table->text('url')->nullable();

            $table->timestamps();

            $table->index([
                'resourceable_type',
                'resourceable_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
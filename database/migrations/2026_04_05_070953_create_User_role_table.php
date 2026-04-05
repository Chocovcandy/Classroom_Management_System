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
        Schema::create('User_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('User')
                  ->onDelete('cascade');
            $table->foreignId('role_id')
                    ->constrained('Role')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_user_role');
    }
};

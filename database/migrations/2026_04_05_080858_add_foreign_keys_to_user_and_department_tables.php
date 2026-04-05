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
        Schema::table('User', function (Blueprint $table) {
            $table->foreign('department_id')
                ->references('id')->on('Department')
                ->onDelete('set null');
        });

        Schema::table('Department', function (Blueprint $table) {
            $table->foreign('head_id')
                ->references('id')->on('User')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('User', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });

        Schema::table('Department', function (Blueprint $table) {
            $table->dropForeign(['head_id']);
        });
    }
};

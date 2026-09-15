<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->string('google_form_url')->nullable()->after('description');
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->string('google_form_url')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropColumn('google_form_url');
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('google_form_url');
        });
    }
};
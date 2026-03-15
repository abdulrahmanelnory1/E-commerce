<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories','created_at')) {
                $table->timestamps();
            }
        });
        Schema::table('sub_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_categories','created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};

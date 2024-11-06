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
        Schema::table('upcomings', function (Blueprint $table) {
            $table->string('big_title')->nullabe()->after('title');
            $table->text('great_description')->nullabe()->after('big_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upcomings', function (Blueprint $table) {
            $table->dropColumn('big_title');
            $table->dropColumn('great_description');
        });
    }
};

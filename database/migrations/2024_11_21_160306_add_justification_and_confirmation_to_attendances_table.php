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
        Schema::table('attendances', function (Blueprint $table) {
            $table->text('justification_reason')->nullable()->after('status');
            $table->boolean('is_confirmed')->default(false)->after('justification_reason');
            $table->unsignedBigInteger('confirmed_by')->nullable()->after('is_confirmed');
            $table->timestamp('confirmed_at')->nullable()->after('confirmed_by');
    
            // Thêm khoá ngoại nếu cần
            $table->foreign('confirmed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['justification_reason', 'is_confirmed', 'confirmed_by', 'confirmed_at']);
        });
    }
};

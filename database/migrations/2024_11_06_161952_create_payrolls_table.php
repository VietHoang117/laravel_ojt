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
        Schema::create('payrolls', function (Blueprint $table) {
            Schema::create('payrolls', function (Blueprint $table) {
                $table->id();
                $table->integer('valid_workdays');
                $table->integer('invalid_workdays');
                $table->string('month'); // E.g., "2024-11"
                $table->decimal('salary_received', 10, 2);
                $table->string('processed_by');
                $table->timestamp('processed_at');
                $table->string('updated_by')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};

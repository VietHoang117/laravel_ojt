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
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->integer('valid_workdays')->comment('Ngày công hợp lệ');
                $table->integer('invalid_workdays')->comment('Ngày không hợp lệ');
                $table->string('month'); // E.g., "2024-11"
                $table->decimal('salary_received', 10)->comment('Lương được nhận');
                $table->enum('type', ['month', 'day'])->comment('theo tháng, theo ngày');
                $table->integer('processed_by');
                $table->timestamps();
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
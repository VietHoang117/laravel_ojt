<?php

use App\Enums\DepartmentStatusEnum;
use App\Models\Department;
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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->enum('status', DepartmentStatusEnum::getValues())->default(DepartmentStatusEnum::DEACTIVATED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department');
    }
};

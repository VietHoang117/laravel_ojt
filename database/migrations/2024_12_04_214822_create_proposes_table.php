<?php

use App\Enums\LeaveStatusEnum;
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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger(column: 'proposal_type_id')->comment('Khóa ngoại đến bảng loại đề xuất');
            $table->string('proposal_name')->comment('Tên đề xuất');
            $table->string('content', 300);
            $table->enum('status', allowed: LeaveStatusEnum::getValues())->default(LeaveStatusEnum::DRAFT); // trang thái nháp, gửi duyệt, từ chối, hoàn thành
            $table->unsignedInteger(column: 'user_id')->comment('Người khởi tạo');
            $table->unsignedInteger('user_manager_id')->comment('Người quản lý');
            $table->unsignedInteger('user_reviewer_id')->nullable()->comment('Người duyệt');
            $table->timestamps();
        });

        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id'); // Foreign key to proposals table
            $table->string('file_name');
            $table->text('file_path');
            $table->timestamps();
    
        });

        Schema::create('proposal_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
        Schema::dropIfExists('attachments');
        Schema::dropIfExists('proposal_types');
    }
};

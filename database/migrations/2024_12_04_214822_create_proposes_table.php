<?php

use App\Enums\LeaveStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'proposal_type_id')->comment('Khóa ngoại đến bảng loại đề xuất');
            $table->string('proposal_name')->comment('Tên đề xuất');
            $table->string('content', 300);
            $table->date('from_date')->nullable()->comment('Từ ngày');
            $table->date('to_date')->nullable()->comment('Đến ngày');
            $table->enum('type_of_vacation', ['Sáng', 'Chiều'])->default('Sáng')->nullable()->comment('Chọn Loại nghỉ');
            $table->enum(column: 'status', allowed: LeaveStatusEnum::getValues())->default(LeaveStatusEnum::DRAFT); // trang thái nháp, gửi duyệt, từ chối, hoàn thành
            $table->enum('rest_type', ['Nghỉ phép', 'Nghỉ không phép'])->default('Nghỉ phép')->comment('Chọn kiểu nghỉ');
            $table->unsignedInteger(column: 'user_id')->comment('Người khởi tạo');
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
            $table->string('type_name')->unique();
            $table->timestamps();
        });


        DB::table('proposal_types')->insert([
            [
                'type_name' => 'Nghỉ toàn ca'
            ], 
            [
                'type_name' => 'Nghỉ nửa ca'
            ]
        ]);

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

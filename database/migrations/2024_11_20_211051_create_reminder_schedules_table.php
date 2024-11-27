<?php

use App\Models\ReminderSchedule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\AttendanceStatusEnum;
use App\Enums\ReminderScheduleStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reminder_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Nhân viên
            $table->string('email'); // Email nhận nhắc nhở
            $table->time('reminder_time'); // Thời gian nhắc nhở
            $table->enum('status', AttendanceStatusEnum::getValues())->default(AttendanceStatusEnum::VALID); // Trạng thái
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('reminder_schedule_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reminder_schedule_id');
            $table->text('error_message')->nullable();
            $table->enum('status', ReminderScheduleStatusEnum::getValues())->default(ReminderScheduleStatusEnum::NOTSENT);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminder_schedules');
        Schema::dropIfExists('reminder_schedule_logs');
    }
};

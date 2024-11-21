<?php

namespace App\Console\Commands;

use App\Enums\AttendanceStatusEnum;
use Illuminate\Console\Command;
use App\Models\Attendance;
use Carbon\Carbon;

class ScanAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scan-attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quét bảng chấm công và cập nhật trạng thái hợp lệ hoặc không hợp lệ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    
        // $this->info('Bắt đầu quét bảng chấm công...');

        // // Lấy tất cả các bản ghi chưa được xác nhận
        // $attendances = Attendance::whereNull('status')->get();

        // foreach ($attendances as $attendance) {

        //     if ($attendance->check_in && !empty($attendance->check_out)) {
        //         $attendance->update(['status' => AttendanceStatusEnum::INVALID]);
        //     }

        //     $this->info("Cập nhật trạng thái cho chấm công ID: {$attendance->id}");
        // }

        // $this->info('Hoàn thành quét bảng chấm công.');
    }
}

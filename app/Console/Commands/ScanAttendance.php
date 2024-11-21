<?php

namespace App\Console\Commands;

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
        $start_time = Carbon::now()->setTime(8, 0, 0);
        $end_time = Carbon::now()->setTime(17, 0, 0);

        $this->info('Bắt đầu quét bảng chấm công...');

        // Lấy tất cả các bản ghi chưa được xác nhận
        $attendances = Attendance::whereNull('status')->get();

        foreach ($attendances as $attendance) {
            $checkIn = Carbon::parse($attendance->check_in);
            $checkOut = $attendance->check_out ? Carbon::parse($attendance->check_out) : null;

            if ($checkOut && $checkIn->lessThan($start_time) && $checkOut->greaterThan($end_time)) {
                $attendance->update(['status' => 'Hợp lệ']);
            } else {
                $attendance->update(['status' => 'Không hợp lệ']);
            }

            $this->info("Cập nhật trạng thái cho chấm công ID: {$attendance->id}");
        }

        $this->info('Hoàn thành quét bảng chấm công.');
    }
}

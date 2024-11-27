<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExampleEmail;
use App\Models\ReminderSchedule;
use Illuminate\Support\Facades\DB;
use App\Enums\ReminderScheduleStatusEnum;
use Illuminate\Support\Facades\Auth;


class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $reminder;

    public function __construct(ReminderSchedule $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Gửi email
            Mail::to($this->reminder->email)->send(new ExampleEmail([
                'name' => $this->reminder->user->name,
                'checkin_url' => env('APP_URL') . 'admin'
            ]));
        
            // Lưu log khi gửi thành công
            DB::table('reminder_schedule_logs')->insert([
                'reminder_schedule_id' => $this->reminder->id,
                'status' => ReminderScheduleStatusEnum::SENT,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
        } catch (\Exception $e) {
            // Lưu log khi gửi thất bại
            DB::table('reminder_schedule_logs')->insert([
                'reminder_schedule_id' => $this->reminder->id,
                'status' => ReminderScheduleStatusEnum::NOTSENT,
                'error_message' => $e->getMessage(), // Lưu thông tin lỗi
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
        }
        
    }
}
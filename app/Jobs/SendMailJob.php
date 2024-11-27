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
use Illuminate\Console\Command;


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
        Mail::to($this->reminder->email)->send(new ExampleEmail([
            'name' => $this->reminder->user->name, // Lấy tên nhân viên
        ]));
        ReminderSchedule::where('id', $this->reminder->id)->update(['is_sent' => true]);
    }
}

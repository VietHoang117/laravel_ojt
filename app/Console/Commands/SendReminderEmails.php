<?php

namespace App\Console\Commands;
use App\Models\ReminderSchedule;
use Illuminate\Console\Command;
use App\Jobs\SendMailJob;
use Carbon\Carbon;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = ReminderSchedule::query()
            ->with('user')
            ->get();

        foreach ($reminders as $reminder) {
            $reminderTime = Carbon::today()->setTimeFromTimeString($reminder->reminder_time);

            $delay = Carbon::now()->diffInSeconds($reminderTime, false);
            
            if ($delay > 0) {
                SendMailJob::dispatch($reminder)->delay($delay);
                $this->info("Scheduled reminder for: {$reminder->email} at {$reminder->reminder_time}");
            }
        }
    }
}

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
{
    // Check-in reminders
    $schedule->call(function () {
        $currentTime = now()->format('H:i');

        $users = \App\Models\User::where(function ($query) use ($currentTime) {
            $query->where('custom_checkin_time', $currentTime)
                  ->orWhere(function ($subquery) {
                      $subquery->whereNull('custom_checkin_time')
                               ->whereRaw("TIME('08:00') = '{$currentTime}'");
                  });
        })->get();

        foreach ($users as $user) {
            \Mail::to($user->email)->send(new \App\Mail\CheckInReminder($user));
        }
    })->everyMinute(); // Check every minute for users to notify

    // Check-out reminders
    $schedule->call(function () {
        $currentTime = now()->format('H:i');

        $users = \App\Models\User::where(function ($query) use ($currentTime) {
            $query->where('custom_checkout_time', $currentTime)
                  ->orWhere(function ($subquery) {
                      $subquery->whereNull('custom_checkout_time')
                               ->whereRaw("TIME('17:00') = '{$currentTime}'");
                  });
        })->get();

        foreach ($users as $user) {
            \Mail::to($user->email)->send(new \App\Mail\CheckOutReminder($user));
        }
    })->everyMinute();

    $schedule->command('generate:monthly-payroll')->monthly();
}


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    
}
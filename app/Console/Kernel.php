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
        $schedule->command('app:update-payrolls')->dailyAt('6:00');
        $schedule->command('attendance:scan')->dailyAt('23:00'); // Chạy hàng ngày lúc 23h
        $schedule->command('reminders:send')->dailyAt('6:00'); //Chạy hàng ngày lúc 6h
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    

}

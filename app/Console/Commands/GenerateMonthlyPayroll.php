<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateMonthlyPayroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-monthly-payroll';

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
    app(PayrollController::class)->storePayroll();
    $this->info('Bảng lương hàng tháng đã được tính toán!');
    }

}
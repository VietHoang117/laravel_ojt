<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class updatePayrolls extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-payrolls';

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
        $users = User::select('id', 'name')->whereHas('roles',function($query) {

            return $query->where('is_system_role', '!=', true);
        })->get();

        foreach($users as $user){
            
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

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
        $users = User::query()
        ->whereHas('roles',function($query) {
            return $query->where('is_system_role', '!=', true);
        })
        ->with('attendances', function ($query) {
            $query->where('status', 'presert');
        })
        ->get();
        dd($users);
        foreach($users as $user){
            
        }
    }
}

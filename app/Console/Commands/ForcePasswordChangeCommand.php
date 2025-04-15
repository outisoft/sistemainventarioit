<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ForcePasswordChangeCommand extends Command
{
    protected $signature = 'users:force-password-change';
    protected $description = 'Force all non-admin users to change their password on next login';

    public function handle()
    {
        User::whereDoesntHave('roles', function($query) {
            $query->where('name', 'Administrat');
        })->update([
            'force_password_change' => true
        ]);
        
        $this->info('All non-admin users will be forced to change their password on next login.');
    }
}

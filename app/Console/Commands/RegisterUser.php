<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class RegisterUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'signup:register
                            {name : user name}
                            {password : password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register user from cli';

    public function handle()
    {
        $name = $this->argument('name');
        $password = $this->argument('password');
        $user = User::create([
            'name' => $name,
            'password' => bcrypt($password),
        ]);
        $this->info("User {$user->name} registered.");
    }
}

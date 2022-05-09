<?php

namespace App\Console\Commands\Init;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:admin
    {--user=admin@admin.com}
    {--password=password}
    ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->option('user');
        $user = new User();
        $user->name = preg_replace("/@.*$/", "", $email);
        $user->email = $email;
        $user->password = Hash::make($this->option('password'));
        $user->save();
        return 0;
    }
}

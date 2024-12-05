<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashUserPasswords extends Command
{
    protected $signature = 'users:hash-passwords';
    protected $description = 'Hash passwords for users who don\'t have a hashed password';

    public function handle()
    {
        $users = User::whereNull('password')->orWhere('password', '!=', Hash::make(''))->get();

        foreach ($users as $user) {
            $user->password = Hash::make($user->password);
            $user->save();
        }

        $this->info('Passwords hashed successfully!');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'theknower@gmail.com'],
            [
                'name' => 'TheKnower',
                'password' => Hash::make('theknower123@@'), 
                'role' => 'admin',
            ]
        );
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['email' => env('ADMIN_DEFAULT_EMAIL')],
            [
                'name' => env('ADMIN_DEFAULT_NAME', 'Admin'),
                'password' => Hash::make(env('ADMIN_DEFAULT_PASSWORD')),
            ]
        );
    }
}
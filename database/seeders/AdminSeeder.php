<?php

namespace Database\Seeders;

use App\Domain\Users\Models\User;
use App\Panel\Enums\PanelEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |-------------------------------
        | Admin Users Data
        |-------------------------------
        */

        $admins = [
            [
                'first_name' => 'MHD',
                'last_name' => 'Admin',
                'email' => 'admin@mhd.com',
                'password' => '12345test',
                'panel_id' => PanelEnum::ADMIN->value,
                'email_verified_at' => now(),
            ],

            [
                'first_name' => 'Khaled',
                'last_name' => 'Moussa',
                'email' => 'khaledmoussaeid@gmail.com',
                'password' => '12345test',
                'panel_id' => PanelEnum::ADMIN->value,
                'email_verified_at' => now(),
            ],
        ];

        /*
        |-------------------------------
        | Create Users
        |-------------------------------
        */

        foreach ($admins as $admin) {
            User::firstOrCreate(
                ['email' => $admin['email']],
                [
                    'first_name' => $admin['first_name'],
                    'last_name'  => $admin['last_name'],
                    'panel_id'      => $admin['panel_id'],
                    'password'   => Hash::make('12345test'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}

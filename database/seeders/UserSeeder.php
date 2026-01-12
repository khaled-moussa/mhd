<?php

namespace Database\Seeders;

use App\Domain\Roles\Models\CustomRole;
use App\Domain\Users\Models\User;
use App\Panel\Enums\PanelEnum;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::create([
            'first_name' => 'Khaled',
            'last_name' => 'Moussa',
            'email' => 'khaledmoussaeid@gmail.com',
            'password' => '12345Test**',
            'panel_id' => PanelEnum::ADMIN->value,
            'email_verified_at' => now(),
        ]);

        $user->setting()->create();
    }
}

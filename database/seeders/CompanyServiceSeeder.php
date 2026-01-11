<?php

namespace Database\Seeders;

use App\Domain\CompanyServices\Models\CompanyService;
use Illuminate\Database\Seeder;

class CompanyServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = config("landing.sections.services.data");

        foreach ($services as $service) {
            CompanyService::create($service);
        }
    }
}

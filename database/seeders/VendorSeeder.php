<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            ['name' => 'PIA (Pakistan International Airlines)', 'status' => 'Active'],
            ['name' => 'Airblue', 'status' => 'Active'],
            ['name' => 'AirSial', 'status' => 'Active'],
            ['name' => 'SereneAir', 'status' => 'Active'],
            ['name' => 'Emirates', 'status' => 'Active'],
            ['name' => 'Qatar Airways', 'status' => 'Active'],
            ['name' => 'FlyDubai', 'status' => 'Active'],
            ['name' => 'Saudia (Saudi Arabian Airlines)', 'status' => 'Active'],
            ['name' => 'Turkish Airlines', 'status' => 'Active'],
            ['name' => 'Etihad Airways', 'status' => 'Active'],
            ['name' => 'Gulf Air', 'status' => 'Inactive'],
        ];

        foreach ($airlines as $data) {
            Vendor::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}

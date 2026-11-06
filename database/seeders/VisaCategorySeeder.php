<?php

namespace Database\Seeders;

use App\Models\VisaCategory;
use Illuminate\Database\Seeder;

class VisaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tourist Visa', 'status' => 'Active'],
            ['name' => 'Visit / Family Visa', 'status' => 'Active'],
            ['name' => 'Work / Employment Visa', 'status' => 'Active'],
            ['name' => 'Business Visa', 'status' => 'Active'],
            ['name' => 'Student / Study Visa', 'status' => 'Active'],
            ['name' => 'Umrah Visa', 'status' => 'Active'],
            ['name' => 'Hajj Visa', 'status' => 'Active'],
            ['name' => 'Transit Visa', 'status' => 'Active'],
            ['name' => 'Medical Visa', 'status' => 'Active'],
            ['name' => 'Freelance / Green Visa', 'status' => 'Inactive'],
        ];

        foreach ($categories as $data) {
            VisaCategory::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}


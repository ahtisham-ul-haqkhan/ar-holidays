<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'title' => 'Mr.',
                'name' => 'Muhammad Hamza',
                'cnic' => '35202-8492019-3',
                'dob' => '1990-06-14',
                'gender' => 'Male',
                'passport' => 'PK8829104',
                'email' => 'hamza.travels@gmail.com',
                'number' => '+92 300 8472910',
                'address' => 'House 42-B, Phase 5 DHA, Lahore',
                'status' => 'Active',
            ],
            [
                'title' => 'Ms.',
                'name' => 'Fatima Zahra',
                'cnic' => '61101-1928374-2',
                'dob' => '1995-02-28',
                'gender' => 'Female',
                'passport' => 'PK9920182',
                'email' => 'fatima.zahra@outlook.com',
                'number' => '+92 321 4455667',
                'address' => 'Flat 12, Executive Heights, F-10 Markaz, Islamabad',
                'status' => 'Active',
            ],
            [
                'title' => 'Mr.',
                'name' => 'Tariq Mehmood',
                'cnic' => '42101-5829104-5',
                'dob' => '1984-11-03',
                'gender' => 'Male',
                'passport' => 'PK7710928',
                'email' => 'tariq.mehmood@company.pk',
                'number' => '+92 333 9988776',
                'address' => 'Plot 88, Street 4, Clifton Block 2, Karachi',
                'status' => 'Inactive',
            ],
        ];

        foreach ($customers as $data) {
            Customer::updateOrCreate(
                ['cnic' => $data['cnic']],
                $data
            );
        }
    }
}

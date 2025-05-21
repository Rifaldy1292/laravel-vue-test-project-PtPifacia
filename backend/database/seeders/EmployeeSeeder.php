<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'John Doe',
                'profile' => json_encode([
                    'address' => '1234 Main St, City, Country',
                    'phone' => '+1234567890',
                    'email' => 'john.doe@example.com',
                ]),
                'hire_date' => '2020-01-01',
                'cv' => 'storage/cvs/john_doe_cv.pdf',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null, // Tidak dihapus secara soft delete
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Jane Smith',
                'profile' => json_encode([
                    'address' => '5678 Oak St, Another City, Country',
                    'phone' => '+0987654321',
                    'email' => 'jane.smith@example.com',
                ]),
                'hire_date' => '2019-03-15',
                'cv' => 'storage/cvs/jane_smith_cv.pdf',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}

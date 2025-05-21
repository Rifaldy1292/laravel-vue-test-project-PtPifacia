<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil UUID dari tabel employees dan roles
        $employeeId = DB::table('employees')->first()->id;
        $roleId = DB::table('roles')->where('name', 'admin')->first()->id; // Misalnya kita beri role 'admin'

        // Menyisipkan data pengguna (user)
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'employee_id' => $employeeId,  // Menggunakan UUID dari tabel employees
            'role_id' => $roleId,          // Menggunakan UUID dari tabel roles
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password123'), // Pastikan password di-hash
            'description' => json_encode([
                'notes' => 'Admin user for managing the platform.',
            ]),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        // Menambahkan user lainnya jika diperlukan
    }
}

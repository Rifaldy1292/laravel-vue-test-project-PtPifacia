<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\EmployeeSeeder; 
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan UserSeeder untuk menambahkan data user
        $this->call([
            EmployeeSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,  // Memastikan UserSeeder dipanggil
        ]);
    }
}

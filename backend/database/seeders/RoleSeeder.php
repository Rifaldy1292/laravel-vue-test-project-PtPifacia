<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'admin',
                'description' => json_encode([
                    'permissions' => ['create', 'edit', 'delete', 'view'],
                    'notes' => 'Role with full permissions for managing the system.'
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null, // Tidak dihapus secara soft delete
            ],
            [
                'id' => Str::uuid(),
                'name' => 'user',
                'description' => json_encode([
                    'permissions' => ['view'],
                    'notes' => 'Role with limited access, can only view content.'
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'manager',
                'description' => json_encode([
                    'permissions' => ['create', 'edit', 'view'],
                    'notes' => 'Role with elevated access, can manage content and view analytics.'
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}

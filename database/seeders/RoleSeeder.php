<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(
            ['name' => 'super_admin', 'guard_name' => 'web']
        );

        Role::firstOrCreate(
            ['name' => 'project_admin', 'guard_name' => 'web']
        );

        Role::firstOrCreate(
            ['name' => 'project_manager', 'guard_name' => 'web']
        );

        Role::firstOrCreate(
            ['name' => 'employee', 'guard_name' => 'web']
        );

    }
}

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

        Role::create([
            'guard_name' => 'web',
            'name' => 'Project Admin'
        ]);

        Role::create([
            'guard_name' => 'web',
            'name' => 'Project Manager'
        ]);

        Role::create([
            'guard_name' => 'web',
            'name' => 'Employee'
        ]);

    }
}

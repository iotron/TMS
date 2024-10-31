<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdminUser = User::factory()
            ->create(['email' => 'superadmin@example.com']);

        $superAdminUser->assignRole('super_admin');

        $demoUser = User::factory()
            ->create(['email' => 'user@example.com']);
        $demoUser->assignRole('project_admin');

        // Extra Users

        User::factory(20)->create()->each(function ($user){
            $user->assignRole('employee');
        });

    }
}

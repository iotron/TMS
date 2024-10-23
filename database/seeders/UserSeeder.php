<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdminUser = User::factory()
            ->create(['email' => 'superadmin@example.com']);

        $demoUser = User::factory()
            ->create(['email' => 'user@example.com']);

        // Extra Users

        User::factory(20)->create();

    }
}

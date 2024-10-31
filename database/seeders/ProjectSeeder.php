<?php

namespace Database\Seeders;

use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $demoUser = User::firstWhere('email','user@example.com');


        $assignableUsers = User::whereNotIn('email', ['superadmin@example.com', 'user@example.com'])->get();


        $demoProjects = Project::factory(5)
            ->hasTasks(30,['user_id' => $demoUser->id])
            ->hasSprints(5)
            ->create()
            ->each(function (Project $project) use($assignableUsers) {
                $project->users()->attach($assignableUsers->skip(1)->random(1));
            });



    }
}

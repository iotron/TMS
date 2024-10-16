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

        $demoProjects = Project::factory(10)
            ->hasTasks(10,['user_id' => $demoUser->id])
            ->hasSprints(5)
            ->create()
            ->each(function (Project $project) use($demoUser) {
                $project->users()->attach($demoUser);
            });



    }
}

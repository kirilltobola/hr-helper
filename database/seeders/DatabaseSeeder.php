<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PositionSeeder::class,
            ProgrammingLevelSeeder::class,
            StatusSeeder::class,
            CvSeeder::class,
            CandidateSeeder::class,
        ]);
    }
}

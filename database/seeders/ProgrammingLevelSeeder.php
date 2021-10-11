<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgrammingLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programming_levels')->insert([
            [
                'name' => 'intern'
            ],
            [
                'name' => 'junior'
            ],
            [
                'name' => 'middle'
            ],
            [
                'name' => 'senior'
            ],
            [
                'name' => 'n/a'
            ],
        ]);
    }
}

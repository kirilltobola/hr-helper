<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidates')->insert([
            [
                'name' => 'Pomazkin Maksim',
                'email' => 'pomazkin.m@adict.ru',
                'cv_id' => 1
            ],
            [
                'name' => 'Tobola Kirill',
                'email' => 'tobola.k@adict.ru',
                'cv_id' => 2
            ],
            [
                'name' => 'Syharev Mihail',
                'email' => 'syharec.m@adict.ru',
                'cv_id' => 3
            ],
        ]);
    }
}

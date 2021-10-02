<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cvs')->insert([
            [
                'skills' => 'some skills 1',
                'cv' => 'Pomazkin Maksim CV',
                'experience' => 'some experience 1',
                'position' => 1,
                'programming_level' => 2,
                'date' => '2021.10.11',
                'status' => 3
            ],
            [
                'skills' => 'some skills 2',
                'cv' => 'Tobola Kirill CV',
                'experience' => 'some experience 2',
                'position' => 2,
                'programming_level' => 2,
                'date' => '2021.10.12',
                'status' => 1
            ],
            [
                'skills' => 'some skills 3',
                'cv' => 'Syharev Mihail CV',
                'experience' => 'some experience 3',
                'position' => 3,
                'programming_level' => 2,
                'date' => '2021.10.13',
                'status' => 3
            ],
        ]);
    }
}

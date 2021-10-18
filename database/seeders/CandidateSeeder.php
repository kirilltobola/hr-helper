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
                'name' => 'Помазкин Максим',
                'email' => 'pomazkin.m-dev@adict.ru',
                'cv_id' => 1
            ],
            [
                'name' => 'Тобола Кирилл',
                'email' => 'tobola.k-dev@adict.ru',
                'cv_id' => 2
            ],
            [
                'name' => 'Сухарев Михаил',
                'email' => 'syharev.m-dev@adict.ru',
                'cv_id' => 3
            ],
        ]);
    }
}

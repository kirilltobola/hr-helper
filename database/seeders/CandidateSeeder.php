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
                'email' => 'zinddmax@gmail.com',
                'cv_id' => 1
            ],
            [
                'name' => 'Тобола Кирилл',
                'email' => 'kirilltobola@gmail.com',
                'cv_id' => 2
            ],
            [
                'name' => 'Сухарев Михаил',
                'email' => 'mishapsyxarev@gmail.com',
                'cv_id' => 3
            ],
        ]);
    }
}

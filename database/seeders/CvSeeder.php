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
                'skills' => '<p>php8+</p><p>Laravel8+</p><p>git</p><p>MySQL/MariaDB</p>',
                'cv' => '<p>Я студент 4 курса ИМИТ ИГУ (направление Фундаментальная информатика и информационные технологии).</p><p>С июня по октябрь проходил IT-курс по программированию на PHP от BDA.</p><p>HR-helper является финальным проектом этого курса.</p><p>Опыта разработки как-такового у меня нет, кроме HR-helper.</p><p>Кроме PHP, так же немного знаком с HTML и CSS, делал пару простеньких лендингов. Так же знаком с основами JS.</p><p>Знаком с ООП, SOLID.</p>',
                'experience' => '<p><span style="background-color: rgb(254, 254, 254);">-</span></p>',
                'position_id' => 1,
                'programming_level_id' => 2,
                'date' => '2021.10.11',
                'status_id' => 3
            ],
            [
                'skills' => '<p>php 7.4</p><p>Laravel 8</p><p>ООП</p><p>git</p><p>MySQL/MariaDB</p><p>linux</p>',
                'cv' => '<p>Студент 4-го курса ИМИТ ИГУ.</p><p>Увлекся бекендом около года назад. Делал пет-проекты на PHP, Django, GO, Spring MVC.</p><p>Знаком с принципами ООП, SOLID, а также с паттернами проектирования.</p><p>В ближайшее время хочу начать карьеру php-junior разработчика. </p>',
                'experience' => '<p>-</p>',
                'position_id' => 1,
                'programming_level_id' => 2,
                'date' => '2021.10.12',
                'status_id' => 1
            ],
            [
                'skills' => '<p>laravel8+</p><p>git</p><p>php8+</p><p>sql</p>',
                'cv' => '<p><strong>Студент ИМИТ ИГУ 3 курс, направление "Прикладная информатика"</strong></p><p>Знаком с парадигмой программирования&nbsp;<strong>ООП</strong>, в курсе про принципы&nbsp;<strong>SOLID</strong>.</p><p>Единственный опыт программирования на php был в рамках этого курса.</p>',
                'experience' => '<p><span style="background-color: rgb(254, 254, 254);">-</span></p>',
                'position_id' => 1,
                'programming_level_id' => 2,
                'date' => '2021.10.13',
                'status_id' => 3
            ],
        ]);
    }
}

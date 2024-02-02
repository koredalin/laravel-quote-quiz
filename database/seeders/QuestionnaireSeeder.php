<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questionnaires')->insert([
            [
                'title' => 'Famous Quotes 1',
                'mode' => 'binary',
                'description' => '"Yes", "No" available answers.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Famous Quotes 2',
                'mode' => 'multiple_choice',
                'description' => '"A", "B", "C" available answers.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

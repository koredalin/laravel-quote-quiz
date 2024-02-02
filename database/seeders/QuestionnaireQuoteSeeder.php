<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class QuestionnaireQuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questionnaires_quotes')->insert([
            // Binary choice answers.
            [
                'questionnaire_id' => 1,
                'quote_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 1,
                'quote_id' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Multiple choice answers.
            [
                'questionnaire_id' => 2,
                'quote_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 16,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 17,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 19,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'questionnaire_id' => 2,
                'quote_id' => 21,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

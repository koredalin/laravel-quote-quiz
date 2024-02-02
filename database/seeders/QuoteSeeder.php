<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quotes')->insert([
            // Binary questions.
            [
                'question' => '"To be, or not to be, that is the question." - Did William Shakespeare write this?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"I think, therefore I am." - Is this quote attributed to René Descartes?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"The only thing we have to fear is fear itself." - Was this said by Winston Churchill?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"In the beginning God created the heavens and the earth." - Is this a quote from the Quran?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"That\'s one small step for man, one giant leap for mankind." - Was this said by Neil Armstrong?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"I have a dream." - Was this speech delivered by Martin Luther King Jr.?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"Life is what happens when you\'re busy making other plans." - Is this a quote from John Lennon?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"The unexamined life is not worth living." - Did Socrates say this?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"All men are created equal." - Is this a quote from the Declaration of Independence?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"Elementary, my dear Watson." - Is this a quote from Sherlock Holmes in the books by Sir Arthur Conan Doyle?',
                'mode' => 'binary',
                'answer_a' => null,
                'answer_b' => null,
                'answer_c' => null,
                'right_answer' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Multiple choice questions.
            [
                'question' => 'Who said "The greatest glory in living lies not in never falling, but in rising every time we fall"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Nelson Mandela',
                'answer_b' => 'Mahatma Gandhi',
                'answer_c' => 'Abraham Lincoln',
                'right_answer' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Who is the author of "You must be the change you wish to see in the world"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Mother Teresa',
                'answer_b' => 'Mahatma Gandhi',
                'answer_c' => 'Martin Luther King Jr.',
                'right_answer' => 'B',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Who said "It always seems impossible until it\'s done"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Albert Einstein',
                'answer_b' => 'Nelson Mandela',
                'answer_c' => 'Thomas Edison',
                'right_answer' => 'B',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Who wrote "In three words I can sum up everything I\'ve learned about life: it goes on"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Robert Frost',
                'answer_b' => 'William Shakespeare',
                'answer_c' => 'Mark Twain',
                'right_answer' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"Not all those who wander are lost" is a line from which author?',
                'mode' => 'multiple_choice',
                'answer_a' => 'J.R.R. Tolkien',
                'answer_b' => 'C.S. Lewis',
                'answer_c' => 'J.K. Rowling',
                'right_answer' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Who said "The future belongs to those who believe in the beauty of their dreams"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Eleanor Roosevelt',
                'answer_b' => 'Helen Keller',
                'answer_c' => 'Marie Curie',
                'right_answer' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Who is the author of "The only way to do great work is to love what you do"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Steve Jobs',
                'answer_b' => 'Bill Gates',
                'answer_c' => 'Thomas Edison',
                'right_answer' => 'B',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => '"Genius is 1% inspiration and 99% perspiration" was said by?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Nikola Tesla',
                'answer_b' => 'Thomas Edison',
                'answer_c' => 'Albert Einstein',
                'right_answer' => 'B',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Who said "The best way to predict the future is to invent it"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Alan Kay',
                'answer_b' => 'Steve Jobs',
                'answer_c' => 'Bill Gates',
                'right_answer' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Who wrote "Imagination is more important than knowledge. Knowledge is limited. Imagination encircles the world"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'Isaac Newton',
                'answer_b' => 'Albert Einstein',
                'answer_c' => 'Stephen Hawking',
                'right_answer' => 'B',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question' => 'Who is the author of the quote "To be, or not to be, that is the question"?',
                'mode' => 'multiple_choice',
                'answer_a' => 'William Shakespeare',
                'answer_b' => 'Leonardo da Vinci',
                'answer_c' => 'Albert Einstein',
                'right_answer' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

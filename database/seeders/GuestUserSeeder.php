<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class GuestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oneMinute = 60;
        DB::table('guest_users')->insert([
            [
                'name' => 'Ivan',
                'surname' => 'Ivanov',
                'email' => 'iiov@example.com',
                'total_score' => 5,
                'duration' => 4 * $oneMinute + 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Stoyan',
                'surname' => 'Stoyanov',
                'email' => 'ssov@example.com',
                'total_score' => 6,
                'duration' => 3 * $oneMinute + 44,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Petar',
                'surname' => 'Petrov',
                'email' => 'ppov@example.com',
                'total_score' => 8,
                'duration' => 4 * $oneMinute + 21,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Petar',
                'surname' => 'Popangelov',
                'email' => 'ppopangelov@example.com',
                'total_score' => 8,
                'duration' => 3 * $oneMinute + 34,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dragan',
                'surname' => 'Tsankov',
                'email' => 'dtsankov@example.com',
                'total_score' => 7,
                'duration' => 4 * $oneMinute + 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

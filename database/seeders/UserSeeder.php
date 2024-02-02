<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Hristo Hristov',
                'email' => 'hhristov@user.com',
                'email_verified_at' => '2024-02-02 13:50:57',
                // Temporary Password: "roleuser".
                // TODO - Change on production.
                'password' => '$2y$10$JUJYyxHXOuT1ri0Jep1OvO4tvDDt6I4SFil.ahaPhdULYQd9ft7Qy',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'user',
            ],
            [
                'name' => 'Hristo Hristov',
                'email' => 'hhristov@admin.com',
                'email_verified_at' => '2024-02-02 13:50:57',
                // Temporary Password: "roleadmin".
                // TODO - Change on production.
                'password' => '$2y$10$JQxSTFQPIbPEEmgNwS4uwO9Tb7CKS30cISRjLvVjI1gxB0HClDitO',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'admin',
            ],
        ]);
    }
}

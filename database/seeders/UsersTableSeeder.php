<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // It allows you to run database queries using Laravel's query builder
use Illuminate\Support\Facades\Hash; //passwords are hashed properly before being stored in the database. 

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
          DB::table('users')->insert([
                'name' => 'Demo',
                'email' => 'demo@example.com',
                'password' => Hash::make('password'),
            ]);
    }
}

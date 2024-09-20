<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>"田中　太郎",
            'email'=>"abc@email.com",
            'password'=>Hash::make('12345'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),

            ]);
            
            
             DB::table('users')->insert([
            'name'=>"佐藤　次郎",
            'email'=>"def@email.com",
            'password'=>Hash::make('67890'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),

            ]);
        //
    }
}
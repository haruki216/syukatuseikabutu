<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class recordseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('records')->insert([
            'memo'=>'This is body',
            'user_id'=>'1',
            'weight'=>'60',
            'date'=>Carbon::create(2024, 5, 30),
            'category'=>'ランニング',
            'count_value'=>'10',
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            ]);
        //
    }
}
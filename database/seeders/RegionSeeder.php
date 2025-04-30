<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('regions')->insert([
            ['name' => 'East'],
            ['name' => 'West'],
            ['name' => 'North'],
            ['name' => 'South'],
        ]);
    }
}

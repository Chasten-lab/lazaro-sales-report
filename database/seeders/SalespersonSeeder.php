<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalespersonSeeder extends Seeder
{
    public function run()
    {
        DB::table('salespeople')->insert([
            ['name' => 'Charlie'],
            ['name' => 'Ethan'],
            ['name' => 'Diana'],
            ['name' => 'Bob'],
        ]);
    }
}

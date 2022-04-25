<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['branch' => 'AKI', 'name' => 'AKIAN'],
            ['branch' => 'BIC', 'name' => 'BICUTAN'],
            ['branch' => 'CEN', 'name' => 'CENTURY'],
            ['branch' => 'SUP', 'name' => 'SUPIMA'],
            ['branch' => 'TOS', 'name' => 'TOSEN'],
        ];

        DB::table('branch')->insert($data);
    }
}

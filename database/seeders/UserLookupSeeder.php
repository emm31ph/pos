<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = [
            [
                'code' => 'BRCOMP',
                'fulltitle' => 'Branch/Company',
                'link' => 'branch',
                'fulldesc' => 'Company Module this can give a user a set of company/branch under user.',
            ],
            [
                'code' => 'POST00',
                'fulltitle' => 'Position',
                'link' => 'position',
                'fulldesc' => 'Position lookup',
            ],
            [
                'code' => 'DEPT00',
                'fulltitle' => 'Department',
                'link' => 'department',
                'fulldesc' => 'Department lookup',
            ],
            [
                'code' => 'EMPTYP',
                'fulltitle' => 'Employee Type',
                'link' => 'emptype',
                'fulldesc' => 'Employee Type lookup',
            ],
            [
                'code' => 'EMPSTT',
                'fulltitle' => 'Employee Status',
                'link' => 'empstatus',
                'fulldesc' => 'Employee Status lookup',
            ],
            [
                'code' => 'ID0000',
                'fulltitle' => "ID",
                'link' => 'ids',
                'fulldesc' => 'ID lookup',
            ],
            [
                'code' => 'DED000',
                'fulltitle' => 'Deduction',
                'link' => 'deduction',
                'fulldesc' => 'Deduction lookup',
            ],
            [
                'code' => 'BANKS',
                'fulltitle' => 'ATM',
                'link' => 'ATM',
                'fulldesc' => 'ATM lookup',
            ],
            [
                'code' => 'UOM00',
                'fulltitle' => 'Unit of Measurement (UOM) Codes',
                'link' => 'uom',
                'fulldesc' => 'Unit of Measurement (UOM) Codes',
            ],
        ];

        DB::table('user_lookup')->insert($item);
    }
}

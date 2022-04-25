<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LookupSeeder extends Seeder
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
                'code' => 'GENDER',
                'lookup' => '0001',
                'fulltitle' => 'MALE',
                'fulldesc' => 'MALE',
            ],
            [
                'code' => 'GENDER',
                'lookup' => '0002',
                'fulltitle' => 'FEMALE',
                'fulldesc' => 'FEMALE',
            ],
            [
                'code' => 'CIVIL',
                'lookup' => '0001',
                'fulltitle' => 'Married',
                'fulldesc' => 'Married',
            ],
            [
                'code' => 'CIVIL',
                'lookup' => '0002',
                'fulltitle' => 'Single',
                'fulldesc' => 'Single',
            ],
            [
                'code' => 'CIVIL',
                'lookup' => '0003',
                'fulltitle' => 'Separated',
                'fulldesc' => 'Separated',
            ],
            [
                'code' => 'CIVIL',
                'lookup' => '0004',
                'fulltitle' => 'Divorced',
                'fulldesc' => 'Divorced',
            ],
            [
                'code' => 'CIVIL',
                'lookup' => '0005',
                'fulltitle' => 'Widowed',
                'fulldesc' => 'Widowed',
            ],
            [
                'code' => 'EMPTYP',
                'lookup' => '40001',
                'fulltitle' => 'Regular',
                'fulldesc' => 'Regular',
            ],
            [
                'code' => 'EMPTYP',
                'lookup' => '40002',
                'fulltitle' => 'Probationary',
                'fulldesc' => 'Probationary',
            ],
            [
                'code' => 'EMPTYP',
                'lookup' => '40003',
                'fulltitle' => 'CASUAL',
                'fulldesc' => 'CASUAL',
            ],
            [
                'code' => 'EMPTYP',
                'lookup' => '40004',
                'fulltitle' => 'Seasonal Employment',
                'fulldesc' => 'Seasonal Employment',
            ],
            [
                'code' => 'EMPTYP',
                'lookup' => '40005',
                'fulltitle' => 'Project Employment',
                'fulldesc' => 'Project Employment',
            ],
            [
                'code' => 'EMPTYP',
                'lookup' => '40006',
                'fulltitle' => 'Fixed-Term Employment',
                'fulldesc' => 'Fixed-Term Employment',
            ],
            [
                'code' => 'EMPTYP',
                'lookup' => '40007',
                'fulltitle' => 'Part-time Employment',
                'fulldesc' => 'Part-time Employment',
            ],
            [

                'code' => 'EMPSTT',
                'lookup' => '50001',
                'fulltitle' => 'Active',
                'fulldesc' => 'Active',
            ],
            [

                'code' => 'EMPSTT',
                'lookup' => '50002',
                'fulltitle' => 'Resigned',
                'fulldesc' => 'Resigned',
            ],
            [

                'code' => 'EMPSTT',
                'lookup' => '50003',
                'fulltitle' => 'Retired',
                'fulldesc' => 'Retired',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30001',
                'fulltitle' => 'Admin',
                'fulldesc' => 'Admin',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30002',
                'fulltitle' => 'Accounting',
                'fulldesc' => 'Accounting',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30003',
                'fulltitle' => 'IT DEPARTMENT',
                'fulldesc' => 'IT DEPARTMENT',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30004',
                'fulltitle' => 'Coating',
                'fulldesc' => 'Coating',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30005',
                'fulltitle' => 'MACHINESHOP',
                'fulldesc' => 'MACHINESHOP',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30006',
                'fulltitle' => 'Printing',
                'fulldesc' => 'Printing',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30007',
                'fulltitle' => 'Welding Line',
                'fulldesc' => 'Welding Line',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30008',
                'fulltitle' => 'Shearline',
                'fulldesc' => 'Shearline',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30009',
                'fulltitle' => 'General CAN Line',
                'fulldesc' => 'General CAN Line',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30010',
                'fulltitle' => 'Power press ends',
                'fulldesc' => 'Power press ends',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30011',
                'fulltitle' => 'Electrical',
                'fulldesc' => 'Electrical',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30012',
                'fulltitle' => 'Warehouse',
                'fulldesc' => 'Warehouse',
            ],
            [
                'code' => 'DEPT00',
                'lookup' => '30013',
                'fulltitle' => 'SHEET FED',
                'fulldesc' => 'SHEET FED',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20001',
                'fulltitle' => 'Supervisor',
                'fulldesc' => 'Supervisor',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20002',
                'fulltitle' => 'Asst. Supervisor',
                'fulldesc' => 'Asst. Supervisor',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20003',
                'fulltitle' => 'Manager',
                'fulldesc' => 'Manager',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20004',
                'fulltitle' => 'Asst. Manager',
                'fulldesc' => 'Asst. Manager',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20005',
                'fulltitle' => 'IT',
                'fulldesc' => 'IT',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20006',
                'fulltitle' => 'Programmer',
                'fulldesc' => 'Programmer',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20007',
                'fulltitle' => 'HR',
                'fulldesc' => 'HR',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20008',
                'fulltitle' => 'HR Assistant',
                'fulldesc' => 'HR Assistant',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20009',
                'fulltitle' => 'Acctg Staff',
                'fulldesc' => 'Acctg Staff',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20010',
                'fulltitle' => 'Electrician',
                'fulldesc' => 'Electrician',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20011',
                'fulltitle' => 'Printing Operator',
                'fulldesc' => 'Printing Operator',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20012',
                'fulltitle' => 'Machinist',
                'fulldesc' => 'Machinist',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20013',
                'fulltitle' => 'Welding',
                'fulldesc' => 'Welding',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20014',
                'fulltitle' => 'QC',
                'fulldesc' => 'QC',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20015',
                'fulltitle' => 'Seamer Mechanic',
                'fulldesc' => 'Seamer Mechanic',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20016',
                'fulltitle' => 'Telephone Operator',
                'fulldesc' => 'Telephone Operator',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20017',
                'fulltitle' => 'SORTER/PACKER',
                'fulldesc' => 'SORTER/PACKER',
            ],
            [
                'code' => 'POST00',
                'lookup' => '20018',
                'fulltitle' => 'DELIVERY/WHSE HELPER',
                'fulldesc' => 'DELIVERY/WHSE HELPER',
            ],
            [
                'code' => 'POST00',
                'lookup' => '2019',
                'fulltitle' => 'MACHINE OPERATOR',
                'fulldesc' => 'MACHINE OPERATOR',
            ],
            [
                'code' => 'ID0000',
                'lookup' => '60001',
                'fulltitle' => 'TIN',
                'fulldesc' => 'TIN',
            ],
            [
                'code' => 'ID0000',
                'lookup' => '60002',
                'fulltitle' => 'SSS',
                'fulldesc' => 'SSS',
            ],
            [
                'code' => 'ID0000',
                'lookup' => '60003',
                'fulltitle' => 'PAG-IBIG',
                'fulldesc' => 'PAG-IBIG',
            ],
            [
                'code' => 'ID0000',
                'lookup' => '60004',
                'fulltitle' => 'PhilHealth',
                'fulldesc' => 'PhilHealth',
            ],
            [
                'code' => 'ID0000',
                'lookup' => '60005',
                'fulltitle' => 'GSIS',
                'fulldesc' => 'GSIS',
            ],
            [
                'code' => 'BANKS0',
                'lookup' => '80001',
                'fulltitle' => 'BDO',
                'fulldesc' => 'BDO',
            ],
            [
                'code' => 'BANKS0',
                'lookup' => '80002',
                'fulltitle' => 'PSBank',
                'fulldesc' => 'PSBank',
            ],
            [
                'code' => 'BANKS0',
                'lookup' => '80003',
                'fulltitle' => 'UB',
                'fulldesc' => 'UB',
            ],
            [
                'code' => 'BANKS0',
                'lookup' => '80004',
                'fulltitle' => 'MetroBank',
                'fulldesc' => 'MetroBank',
            ],
            [
                'code' => 'BANKS0',
                'lookup' => '80005',
                'fulltitle' => 'EastWest',
                'fulldesc' => 'EastWest',
            ],
            [
                'code' => 'BANKS0',
                'lookup' => '80006',
                'fulltitle' => 'Security Bank',
                'fulldesc' => 'Security Bank',
            ],
            [
                'code' => 'UOM00',
                'lookup' => 'U00PK',
                'fulltitle' => 'Pack',
                'fulldesc' => 'Pack',
            ],
            [
                'code' => 'UOM00',
                'lookup' => 'U00CS',
                'fulltitle' => 'Case',
                'fulldesc' => 'Case',
            ],
            [
                'code' => 'UOM00',
                'lookup' => 'U0CTN',
                'fulltitle' => 'Carton',
                'fulldesc' => 'Carton',
            ],
            [
                'code' => 'UOM00',
                'lookup' => 'U00EA',
                'fulltitle' => 'Each',
                'fulldesc' => 'Each',
            ],

        ];

        DB::table('lookup')->insert($item);
    }
}

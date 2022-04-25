<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Serial;
use Illuminate\Database\Seeder;

class SerialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $branches = Branch::get();
         
        $counter = [  
            [
                'name'=> 'EMPLOYEE',
                'prefix' =>'EMP',
                'value' => 1, 
            ],  
        ];


    foreach ($branches  as $key => $value) { 
        foreach ($counter  as $value1) {
         
            $data = [
                    [
                        'key' => $value1['name'],
                        'branch' => $value['branch'],
                        'prefix' => $value1['prefix']."-". $value['branch']."-",
                        'value' => 1, 
                        'created_at' => now(), 
                        'updated_at' => now(), 
                    ] 
                    ];

            Serial::insert($data);
        }
    }
    
    
    }
}

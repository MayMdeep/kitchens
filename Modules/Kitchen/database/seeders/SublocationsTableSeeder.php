<?php

namespace Modules\Kitchen\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SublocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sublocations')->insert([  
            [  
                'name' => 'SubLocation 1',  
                'status' => 'Active',  
                'location_id' => 1, // Assuming this ID exists in locations table  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            [  
                'name' => 'SubLocation 2',  
                'status' => 'Inactive',  
                'location_id' => 1,  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            [  
                'name' => 'SubLocation 3',  
                'status' => 'Active',  
                'location_id' => 2, // Assuming this ID exists in locations table  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
        ]);  
    }
}

<?php

namespace Modules\Kitchen\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'name' => 'Refrigerator',
                'status' => 'Active',
                'qr_code' => Str::random(10),
                'kitchen_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kitchen Shelf',
                'status' => 'Inactive',
                'qr_code' => Str::random(10),
                'kitchen_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pantry',
                'status' => 'Active',
                'qr_code' => Str::random(10),
                'kitchen_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

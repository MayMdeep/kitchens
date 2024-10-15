<?php

namespace Modules\Kitchen\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KitchenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kitchens')->insert([
            [
                'name' => 'Main Kitchen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Secondary Kitchen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outdoor Kitchen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

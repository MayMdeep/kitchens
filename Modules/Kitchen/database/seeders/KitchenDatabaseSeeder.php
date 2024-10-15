<?php

namespace Modules\Kitchen\Database\Seeders;

use Illuminate\Database\Seeder;

class KitchenDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(KitchenSeeder::class);
        $this->call(LocationSeeder::class);
    }
}

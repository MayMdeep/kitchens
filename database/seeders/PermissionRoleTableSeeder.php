<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // as a test assign all permissions to the chef and the manager // assume permissions are 25
        for ($i = 1; $i <= 25; $i++) {
            DB::table('permission_roles')->insert([
                'permission_id' => $i,
                'role_id' => 2,
            ]);

            DB::table('permission_roles')->insert([
                'permission_id' => $i,
                'role_id' => 1,
            ]);
        }
    }
}

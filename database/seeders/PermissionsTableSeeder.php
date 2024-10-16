<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
        [ 'name' => 'role.get'],
        [ 'name' => 'role.add'],
        [ 'name' => 'role.edit'],
        [ 'name' => 'role.delete'],
        
        [ 'name' => 'admin.get'],
        [ 'name' => 'admin.add'],
        [ 'name' => 'admin.edit'],
        [ 'name' => 'admin.delete'],

        [ 'name' => 'permission.edit'],
        [ 'name' => 'permission.get'],

        [ 'name' => 'product.add'],
        [ 'name' => 'product.get'],
        [ 'name' => 'product.get-all'],
        [ 'name' => 'product.delete'],
        [ 'name' => 'product.edit'],

        [ 'name' => 'kitchen.add'],
        [ 'name' => 'kitchen.get'],
        [ 'name' => 'kitchen.get-all'],
        [ 'name' => 'kitchen.delete'],
        [ 'name' => 'kitchen.edit'],
        
        [ 'name' => 'location.add'],
        [ 'name' => 'location.get'],
        [ 'name' => 'location.get-all'],
        [ 'name' => 'location.delete'],
        [ 'name' => 'location.edit'],

        [ 'name' => 'product.add'],
        [ 'name' => 'product.get'],
        [ 'name' => 'product.get-all'],
        [ 'name' => 'product.delete'],
        [ 'name' => 'product.edit'],

        [ 'name' => 'subLocation.add'],
        [ 'name' => 'subLocation.get'],
        [ 'name' => 'subLocation.get-all'],
        [ 'name' => 'subLocation.delete'],
        [ 'name' => 'subLocation.edit']


    ]);
    }
}

<?php

namespace Modules\Kitchen\Database\Seeders;

use Faker\Factory;  
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProductsTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    { $products = [
        [
            'name' => 'Product 1',
            'ingredients' => 'Sugar, Water, Flavoring',
            'production_date' => '2022-11-07',
            'expiry_date' => '2025-09-26',
            'location_id' => 1,
            'sub_location_id' => 1,
            'quantity' => 2,
            'alert_quantity' => 1,
        ],
        [
            'name' => 'Product 2',
            'ingredients' => 'Salt, Pepper, Garlic',
            'production_date' => '2024-09-07',
            'expiry_date' => '2025-07-12',
            'location_id' => 2,
            'sub_location_id' => 1,
            'quantity' => 6,
            'alert_quantity' => 2,
        ],
    ];

    foreach ($products as $product) {
        // generate a simple code
        $qrCode = QrCode::format('svg')->size(250)->generate($product['name']);
        $qrCodeDataUri = 'data:image/svg+xml;base64,' . base64_encode($qrCode);
        
        // Check for duplicates
        $existingProduct = DB::table('products')->where('qr_code', $qrCodeDataUri)->first();

        // only if QR code is unique
        if (!$existingProduct) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'ingredients' => $product['ingredients'],
                'production_date' => $product['production_date'],
                'expiry_date' => $product['expiry_date'],
                'location_id' => $product['location_id'],
                'sub_location_id' => $product['sub_location_id'],
                'quantity' => $product['quantity'],
                'alert_quantity' => $product['alert_quantity'],
                'qr_code' => $qrCodeDataUri,
                'status' => 'Active', 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
}










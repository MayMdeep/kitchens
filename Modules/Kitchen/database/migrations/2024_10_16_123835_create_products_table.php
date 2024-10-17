<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {  
            $table->id();  
            $table->string('name');  
            $table->text('ingredients');  
            $table->date('production_date');  
            $table->date('expiry_date')->nullable();  
            $table->foreignId('location_id');  
            $table->foreignId('sub_location_id')->nullable();  
            $table->integer('quantity');  
            $table->integer('alert_quantity')->nullable();  
            $table->text('qr_code')->unique();  
            $table->enum('status', ['Active', 'Inactive']);  
            $table->timestamps();  
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

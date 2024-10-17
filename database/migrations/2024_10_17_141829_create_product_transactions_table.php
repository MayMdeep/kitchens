<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['withdrawal', 'return']);
            $table->foreignId('product_id');
            $table->foreignId('location_id');
            $table->foreignId('user_id'); // The user performing the action
            $table->integer('quantity'); // Quantity withdrawn or returned
            $table->text('notes')->nullable(); // Optional notes for return transactions
            $table->timestamps();
        });
    }
    //->constrained()->onDelete('cascade');
// ->constrained()->onDelete('cascade');
// ->constrained()->onDelete('cascade');

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_transactions');
    }
};

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_name');
            // $table->foreignId('delivery_boy_id')->nullable()->constrained('delivery_boys');
            $table->integer('delivery_duration')->default(30);
            $table->boolean('assigned')->default(false);
            $table->string('order_number');
            $table->foreignId('delivery_boy_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['pending', 'assigned', 'delivered']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

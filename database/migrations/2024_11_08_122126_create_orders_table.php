<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->string('total_price')->unique(); // ID unik dari Midtrans
            $table->string('order_status')->nullable()->default('pending'); // Status order
            $table->string('payment_type')->nullable();
            $table->string('payment_token')->nullable();
            $table->string('snap_url')->nullable();
            $table->string('refund_status')->nullable();
            $table->integer('total_harga'); // Total amount order
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

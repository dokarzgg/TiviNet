<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->index();
            $table->unsignedInteger('speed_mbps')->index();
            $table->unsignedInteger('price');              // harga per bulan (Rupiah)
            $table->string('summary');
            $table->text('description');
            $table->json('features')->nullable();
            $table->string('icon')->default('bi-wifi');
            $table->boolean('is_featured')->default(false); // tampil di beranda
            $table->boolean('is_popular')->default(false);  // label "Terlaris"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('installation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('phone', 30);
            $table->string('email')->nullable();
            $table->text('address');
            $table->text('notes')->nullable();
            $table->string('status')->default('baru'); // baru | dihubungi | terpasang | batal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('installation_requests');
    }
};

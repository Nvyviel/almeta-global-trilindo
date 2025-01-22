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
        Schema::create('seals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('id_seal');
            $table->enum('pickup_point', ['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'bandung', 'jakarta']);
            $table->integer('quantity');
            $table->string('total_price');
            $table->bigInteger('price');
            $table->enum('status', ['requested', 'verification', 'success']);
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seals');
    }
};

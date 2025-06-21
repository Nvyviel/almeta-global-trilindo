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
            $table->string('id_seal');
            $table->enum('pickup_point', ['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'sampit', 'jakarta', 'kumai', 'samarinda', 'balikpapan', 'berau', 'palu', 'bitung', 'gorontalo', 'ambon']);
            $table->integer('quantity');
            $table->string('total_price');
            $table->bigInteger('price');
            $table->enum('status', ['Payment Proccess', 'Under Verification', 'Success', 'Expired'])->default('Payment Proccess');
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

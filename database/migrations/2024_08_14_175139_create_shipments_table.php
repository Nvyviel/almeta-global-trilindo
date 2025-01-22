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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->enum('from_city', ['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'sampit', 'jakarta', 'kumai', 'samarinda', 'balikpapan', 'berau', 'palu', 'bitung', 'gorontalo', 'ambon']);
            $table->enum('to_city', ['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'sampit', 'jakarta', 'kumai', 'samarinda', 'balikpapan', 'berau', 'palu', 'bitung', 'gorontalo', 'ambon']);
            $table->string('vessel_name');
            $table->dateTime('closing_cargo');
            $table->dateTime('etb');
            $table->dateTime('etd');
            $table->dateTime('eta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

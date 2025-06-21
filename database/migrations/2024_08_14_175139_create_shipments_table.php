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
            $table->enum('from_city', ['Surabaya', 'Pontianak', 'Semarang', 'Banjarmasin', 'Sampit', 'Jakarta', 'Kumai', 'Samarinda', 'Balikpapan', 'Berau', 'Palu', 'Bitung', 'Gorontalo', 'Ambon']);
            $table->enum('to_city', ['Surabaya', 'Pontianak', 'Semarang', 'Banjarmasin', 'Sampit', 'Jakarta', 'Kumai', 'Samarinda', 'Balikpapan', 'Berau', 'Palu', 'Bitung', 'Gorontalo', 'Ambon']);
            $table->string('vessel_name');
            $table->dateTime('closing_cargo');
            $table->dateTime('etb');
            $table->dateTime('etd');
            $table->dateTime('eta');
            $table->unsignedBigInteger('rate');
            $table->unsignedBigInteger('rate_per_container');
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

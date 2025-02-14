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
        Schema::create('shipping_instructions', function (Blueprint $table) {
            $table->id();
            $table->string('instructions_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('container_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->foreignId('consignee_id')->constrained()->onDelete('cascade');
            $table->string('no_container');
            $table->string('no_seal');
            $table->string('note')->nullable();
            $table->enum('status', ['Requested','Approved','Rejected'])->default('Requested');
            $table->string('upload_file_si')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_instructions');
    }
};

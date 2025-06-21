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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->foreignId('container_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipping_instruction_id')->constrained()->onDelete('cascade');
            $table->enum('payment_term', ['Port To Port']);
            $table->unsignedBigInteger('weight_rate');
            $table->unsignedBigInteger('document_price');
            $table->unsignedBigInteger('grand_total');
            $table->enum('status', ['Under Verification','Paid','Unpaid','Error'])->default('Unpaid');
            $table->string('upload_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('containers', function (Blueprint $table) {
            // SHIPMENT DATA
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->enum('stuffing', ['Outdoor', 'Indoor']);
            $table->enum('ownership_container', ['COC', 'SOC']);
            $table->enum('load_type', ['Filled', 'Empty']);
            $table->text('notes')->nullable();

            // CONTAINER DATA
            $table->string('id_order')->unique();
            $table->enum('container_type', ['40 Iso Tank', '20 Iso Tank', '20 Open Top', '40 Open Top', '45 Open Top', '40 High Cube', '45 High Cube', '20 GP', '40 GP']);
            $table->integer('quantity');
            $table->string('commodity');
            $table->integer('weight');
            $table->enum('is_danger', ['No', 'Yes']);
            $table->enum('status', ['Requested', 'Approved', 'Canceled'])->default('Requested');
            $table->string('pdf_ro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};

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
        Schema::create('service_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('service')->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->constrained('room')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_room');
    }
};

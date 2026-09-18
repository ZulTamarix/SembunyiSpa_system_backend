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
        Schema::create('review', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->foreignUuid('user_customer_id')->constrained('user_customer')->onDelete('cascade');
            $table->foreignUuid('user_therapist_id')->constrained('user_therapist')->onDelete('cascade');
            $table->string('total_star');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};

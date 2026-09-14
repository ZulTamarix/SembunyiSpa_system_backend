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
        Schema::create('user_therapist', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->foreignUuid('user_id')->constrained('user');
            $table->string('role');
            $table->string('code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_therapist');
    }
};

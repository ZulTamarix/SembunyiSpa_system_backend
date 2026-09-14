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
        Schema::create('package_therapist', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->foreignUuid('package_id')->constrained('package');
            $table->foreignUuid('user_therapist_id')->constrained('user_therapist');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_therapist');
    }
};

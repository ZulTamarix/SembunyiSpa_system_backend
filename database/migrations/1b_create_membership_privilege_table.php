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
        Schema::create('membership_privilege', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->foreignUuid('membership_id')->constrained('membership')->onDelete('cascade');
            $table->string('list');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_privilege');
    }
};

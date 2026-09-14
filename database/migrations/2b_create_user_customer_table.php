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
        Schema::create('user_customer', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->foreignUuid('user_id')->constrained('user');
            $table->foreignUuid('membership_id')->nullable()->constrained('membership');
            $table->string('membership_code')->nullable();
            $table->string('total_booking');
            $table->date('date_joined');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_customer');
    }
};

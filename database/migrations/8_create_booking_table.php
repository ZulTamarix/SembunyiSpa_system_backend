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
        Schema::create('booking', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->string('code');
            $table->foreignUuid('package_id')->constrained('package')->onDelete('cascade');
            $table->foreignUuid('user_customer_id')->nullable()->constrained('user_customer')->onDelete('cascade');
            $table->foreignUuid('user_walkin_id')->nullable()->constrained('user_walkin')->onDelete('cascade');
            $table->date('date_start');
            $table->string('time_start');
            $table->string('time_end');
            $table->foreignUuid('user_therapist_id')->constrained('user_therapist')->onDelete('cascade');
            $table->foreignUuid('room_id')->constrained('room')->onDelete('cascade');
            $table->string('status');
            $table->string('payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};

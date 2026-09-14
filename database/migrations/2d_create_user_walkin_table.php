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
        Schema::create('user_walkin', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->string('name');
            $table->string('phoneNo');
            $table->string('email');
            $table->date('date_joined');
            $table->integer('total_booking');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_walkin');
    }
};

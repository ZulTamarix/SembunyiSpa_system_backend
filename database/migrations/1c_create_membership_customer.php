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
        Schema::create('membership_customer', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT primary key
            $table->foreignUuid('user_customer_id')->constrained('user_customer')->onDelete('cascade');
            $table->foreignUuid('membership_id')->constrained('membership')->onDelete('cascade');
            $table->string('code');
            $table->string('date_joined');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_customer');
    }
};

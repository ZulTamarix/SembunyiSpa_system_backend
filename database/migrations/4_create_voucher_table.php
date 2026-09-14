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
        Schema::create('voucher', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->string('description');
            $table->string('type');
            $table->foreignUuid('user_customer_id')->constrained('user_customer');
            $table->date('date_expired');
            $table->string('status');
            $table->decimal('discount', 10, 2);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};

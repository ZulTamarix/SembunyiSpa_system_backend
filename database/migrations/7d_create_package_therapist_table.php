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
            $table->id(); // auto-increment BIGINT primary key
            $table->foreignUuid('package_id')->constrained('package')->onDelete('cascade');
            $table->foreignUuid('user_therapist_id')->constrained('user_therapist')->onDelete('cascade');
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

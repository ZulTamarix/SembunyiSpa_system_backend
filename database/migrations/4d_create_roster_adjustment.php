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
        Schema::create('roster_adjustment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roster_id')->constrained('roster')->onDelete('cascade');
            $table->string('type');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roster_adjustment');
    }
};

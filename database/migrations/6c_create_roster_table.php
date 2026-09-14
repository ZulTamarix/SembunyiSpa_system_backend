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
        Schema::create('roster', function (Blueprint $table) {
            $table->uuid('id')->primary();   // 👈 uuid primary
            $table->date('date');
            $table->foreignUuid('user_therapist_id')->constrained('user_therapist');
            $table->foreignUuid('roster_leave_id')->nullable()->constrained('roster_leave');
            $table->foreignUuid('roster_shift_id')->nullable()->constrained('roster_shift');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roster');
    }
};

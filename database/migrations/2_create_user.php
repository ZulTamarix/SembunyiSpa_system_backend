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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('name'); 
            $table->string('email'); 
            $table->string('phoneNo'); 
            $table->string('password')->nullable();
            $table->string('status'); 
            $table->string('date_joined')->nullable(); 
            $table->foreignId('membership_id')->nullable()->constrained('membership')->onDelete('cascade');
            $table->string('membership_date_expired')->nullable(); 
            $table->string('specialty')->nullable(); 
            $table->string('code')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};

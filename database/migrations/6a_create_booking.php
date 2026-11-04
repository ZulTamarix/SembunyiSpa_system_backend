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
            $table->id();
            $table->foreignId('package_id')->nullable()->constrained('package')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->foreignId('user_shared_id')->nullable()->constrained('user')->onDelete('cascade');
            $table->date('date_start');
            $table->string('time_start');
            $table->string('time_end');
            $table->string('status');
            $table->string('payment');
            $table->string('payment_type')->nullable();
            $table->decimal('price_original', 10, 2);
            $table->decimal('price_discount', 10, 2)->nullable();
            $table->decimal('price_final', 10, 2);
            $table->string('booking_type');
            $table->string('remark')->nullable();
            $table->string('recorded_time_start')->nullable();
            $table->string('recorded_time_end')->nullable();
            
            $table->foreignId('user_couple_id')->nullable()->constrained('user')->onDelete('cascade');
            $table->foreignId('room_couple_id')->nullable()->constrained('room')->onDelete('cascade');

            // $table->foreignId('room_id')->nullable()->constrained('room')->onDelete('cascade');
            // $table->foreignId('therapist_id')->nullable()->constrained('user')->onDelete('cascade');
            // $table->foreignId('room_couple_id')->nullable()->constrained('room')->onDelete('cascade');
            // $table->foreignId('therapist_couple_id')->nullable()->constrained('user')->onDelete('cascade');


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

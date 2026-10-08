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
        Schema::create('package', function (Blueprint $table) {
            $table->id();
            $table->string('poster');
            $table->string('title');
            $table->string('description');
            $table->integer('duration');
            $table->decimal('price', 10, 2);
            $table->string('gender');
            $table->string('detail');
            $table->string('type');
            $table->foreignId('package_category_id')->nullable()->constrained('package_category')->onDelete('cascade');

            $table->boolean('is_standalone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package');
    }
};

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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->string('email')->unique();
			$table->string('gender')->nullable();
			$table->string('ip_address');
			$table->string('company')->nullable();
			$table->string('city')->nullable();
			$table->string('title')->nullable();
			$table->string('website', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

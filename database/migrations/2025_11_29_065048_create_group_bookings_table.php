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
        Schema::create('group_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('from_city');
            $table->string('to_city');
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->string('passengers'); // e.g., "10-20", "21-30", etc.
            $table->string('name');
            $table->string('email');
            $table->string('phone', 50);
            $table->string('organization')->nullable();
            $table->text('requirements')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_bookings');
    }
};

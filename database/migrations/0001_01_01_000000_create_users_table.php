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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->longText('full_name');
            $table->longText('email')->nullable();
            $table->longText('phone_number')->nullable();
            $table->longText('password')->nullable();
            $table->longText('profile_picture')->default('default.jpg');
            $table->longText('otp_code')->nullable();
            $table->longText('registration_type');
            $table->longText('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

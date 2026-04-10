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
        Schema::create('repair_request_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->longText('Repair_code')->nullable();
            $table->longText('full_name')->nullable();
            $table->longText('phone_number')->nullable();
            $table->longText('brand')->nullable();
            $table->longText('model_number')->nullable();
            $table->longText('description')->nullable();
            $table->enum('warranty', ['no', 'yes'])->default('no');
            $table->longText('labor_service')->nullable();
            $table->longText('submitted_date')->nullable();
            $table->longText('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_request_forms');
    }
};

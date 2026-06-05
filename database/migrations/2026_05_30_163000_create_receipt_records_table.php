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
        if (!Schema::hasTable('receipt_records')) {
            Schema::create('receipt_records', function (Blueprint $table) {
                $table->id();
                
                $table->unsignedBigInteger('job_application_id');
                $table->foreign('job_application_id')
                      ->references('id')
                      ->on('job_applications')
                      ->onDelete('cascade');
                      
                $table->string('receipt_type'); // 'check_in' or 'final'
                $table->string('shop_name');
                $table->string('shop_phone')->nullable();
                $table->text('shop_address')->nullable();
                $table->json('receipt_data'); // Stores estimated cost, parts list, notes, etc.
                
                $table->longText('customer_signature'); // Base64 signature image
                $table->longText('technician_signature')->nullable(); // Base64 signature image (only for check-in)
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_records');
    }
};

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
        if (!Schema::hasTable('shop_services')) {
            Schema::create('shop_services', function (Blueprint $table) {
                $table->id();
    
                $table->unsignedBigInteger('services_id');
                $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
                
                $table->unsignedBigInteger('shop_id');
                $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
    
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_services');
    }
};

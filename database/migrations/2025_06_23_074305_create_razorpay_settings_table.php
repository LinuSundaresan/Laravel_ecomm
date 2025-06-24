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
        Schema::create('razorpay_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(0);
            $table->string('country_name');
            $table->string('currency_name');
            $table->decimal('currency_rate', 10, 2)->default(1);
            $table->string('razorpay_key');
            $table->string('razorpay_secret_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razorpay_settings');
    }
};

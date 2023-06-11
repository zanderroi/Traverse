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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address');
            $table->unsignedBigInteger('phone_number');
            $table->date('birthday');
            $table->string('govtid');
            $table->string('govtid_image')->nullable();
            $table->string('driverslicense');
            $table->string('driverslicense_image')->nullable();
            $table->string('driverslicense2_image')->nullable();
            $table->string('selfie_image')->nullable();
            $table->string('contactperson1');
            $table->unsignedBigInteger('contactperson1number');
            $table->string('contactperson2');
            $table->unsignedBigInteger('contactperson2number');
            $table->enum('user_type', ['admin', 'customer', 'car_owner']);
            $table->enum('account_status', ['Active', 'Deactivated'])->default('Active');
            $table->enum('booking_status', ['Available', 'Pending'])->default('Available');
            $table->softDeletes();
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

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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->string('address');
            $table->string('phone_number');
            $table->date('birthday');
            $table->string('govtid');
            $table->binary('govtid_image')->nullable();
            $table->string('driverslicense');
            $table->binary('driverslicense_image')->nullable();
            $table->binary('selfie_image')->nullable();
            $table->string('contactperson1');
            $table->string('contactperson1number');
            $table->string('contactperson2');
            $table->string('contactperson2number');
            $table->enum('user_type', ['admin', 'customer', 'car_owner']);
            $table->enum('account_status', ['Active', 'Deactivated'])->default('Active');
            $table->enum('booking_status', ['Available', 'Pending'])->default('Available');
            $table->rememberToken();
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

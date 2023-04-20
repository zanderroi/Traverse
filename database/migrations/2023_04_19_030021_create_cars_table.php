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
        Schema::create('cars', function (Blueprint $table) {
            $table->id('car_id');
            $table->binary('display_picture');
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('plate_number');
            $table->string('vehicle_identification_number');
            $table->string('location');
            $table->binary('certificate_of_registration');
            $table->text('car_description');
            $table->decimal('rental_fee', 10, 2);
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->unsignedBigInteger('car_owner_id');
            $table->foreign('car_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('car_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('car_id')->on('cars')->onDelete('cascade');
            $table->string('filename');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_images');
        Schema::dropIfExists('cars');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->binary('display_picture')->nullable();
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('plate_number')->unique();
            $table->string('vehicle_identification_number')->unique();
            $table->string('location');
            $table->binary('certificate_of_registration')->nullable();
            $table->text('car_description');
            $table->decimal('rental_fee', 10, 2);
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->foreignId('car_owner_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('car_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->string('filename');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_images');
        Schema::dropIfExists('cars');
    }
}

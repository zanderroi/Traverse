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
            $table->year('year')->default(2023);
            $table->integer('seats')->default(1);
            $table->string('plate_number')->unique();
            $table->string('vehicle_identification_number')->unique();
            $table->string('location');
            $table->binary('certificate_of_registration')->nullable();
            $table->text('car_description');
            $table->decimal('rental_fee', 10, 2);
            $table->binary('add_picture1')->nullable();
            $table->binary('add_picture2')->nullable();
            $table->binary('add_picture3')->nullable();
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->foreignId('car_owner_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('cars');
    }
}

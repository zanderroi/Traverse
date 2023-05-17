<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingDataTable extends Migration
{
    public function up()
    {
        Schema::create('tracking_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('customer_id');
            $table->double('latitude');
            $table->double('longitude');
            $table->unsignedBigInteger('booking_id');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tracking_data');
    }
}

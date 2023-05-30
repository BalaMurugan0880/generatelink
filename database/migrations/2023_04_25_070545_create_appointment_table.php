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
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('req_name');
            $table->string('req_designation');
            $table->string('req_contact');
            $table->date('apt_date');
            $table->string('apt_time');
            $table->string('pickup_location');
            $table->string('pickup_lat');
            $table->string('pickup_long');
            $table->string('pickup_url');
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->string('customer_vrn');
            $table->string('vehicle_make');
            $table->string('vehicle_model');
            $table->string('dropoff_location');
            $table->string('dropoff_lat');
            $table->string('dropoff_long');
            $table->string('dropoff_url');
            $table->longText('special_notes')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

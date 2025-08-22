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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('oid');
            $table->foreign('oid')->references('id')->on('users');
            $table->string('model_name');
            $table->string('category');
            $table->string('fuel_type');
            $table->string('capacity');
            $table->string('registration_number');
            $table->string('registration_date')->nullable();
            $table->string('validity_date')->nullable();
            $table->string('registration_certificate');
            $table->string('pollution_certificate');
            $table->string('images');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->decimal('latitude', 20, 14);
            $table->decimal('longitude', 20, 14);
            $table->text('street');
            $table->text('suburb');
            $table->text('city');
            $table->text('state');
            $table->string('pincode');
            $table->text('address');
            $table->string('availability');
            $table->string('approval');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

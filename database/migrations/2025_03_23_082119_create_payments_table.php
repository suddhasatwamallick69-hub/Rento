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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bid');
            $table->foreign('bid')->references('id')->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('uid');
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->string('order_id');
            $table->string('status')->default('pending');
            $table->text('admin_notes')->nullable();
            $table->string('payment_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

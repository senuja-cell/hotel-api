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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->string('guest');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('room_number');
            $table->string('room_type');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('nights');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['Confirmed', 'Pending', 'Cancelled', 'Checked In'])->default('Confirmed');
            $table->enum('payment_status', ['Paid', 'Deposit Paid', 'Unpaid', 'Refunded'])->default('Deposit Paid');
            $table->integer('guests_count')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

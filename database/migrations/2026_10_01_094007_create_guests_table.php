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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country')->default('Sri Lanka');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('nic_passport')->nullable();
            $table->enum('tier', ['Platinum VIP', 'Gold VIP', 'Regular Guest'])->default('Regular Guest');
            $table->integer('total_stays')->default(1);
            $table->decimal('lifetime_spend', 12, 2)->default(0);
            $table->string('preferred_room')->default('Deluxe Room');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_instances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->time('checkin');
            $table->time('checkout')->nullable();
            $table->integer('minutes')->default(0);
            $table->decimal('amount', 8, 2)->default(0);
            $table->boolean('is_paid')->default(false);
            $table->foreignId('vehicle_id')->constrained('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_instances');
    }
};

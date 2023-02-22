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
        Schema::create('type_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('description', 100)->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->enum('payment_rules', ['as_resident', 'as_official', 'as_visitor'])->unique();
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
        Schema::dropIfExists('type_vehicles');
    }
};

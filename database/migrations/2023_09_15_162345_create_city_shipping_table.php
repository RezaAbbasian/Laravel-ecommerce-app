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
        Schema::create('city_shipping', function (Blueprint $table) {

            $table->unsignedBigInteger('shipping_id');
            $table->foreign('shipping_id')
                ->references('id')
                ->on('shippings')
                ->onDelete('cascade');

            $table->integer('city_id');
            $table->foreign('city_id')->
            references('id')->
            on('cities')->
            onDelete('cascade');
            $table->primary(['city_id', 'shipping_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_shipping');
    }
};

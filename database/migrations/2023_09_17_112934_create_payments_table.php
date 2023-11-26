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
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->
            references('id')->
            on('orders')->
            onDelete('cascade');
            $table->string('resnumber');
            $table->string('card_name')->nullable();
            $table->string('image')->nullable();
            $table->string('card_num')->nullable();
            $table->string('amount')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('metadata')->nullable();
            $table->enum('type',['Online', 'Offline'])->nullable();
            $table->boolean('status')->default(0);
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

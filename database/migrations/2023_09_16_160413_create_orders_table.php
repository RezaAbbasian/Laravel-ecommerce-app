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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num')->unique();
            $table->string('tracking_code')->nullable()->default(null);
            $table->unsignedBigInteger('parent')->nullable()->default(0);
            $table->integer('shipping_price')->nullable()->default(null);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->
            references('id')->
            on('users');

            $table->unsignedBigInteger('shipping_id');
            $table->foreign('shipping_id')->
            references('id')->
            on('shippings');

            $table->unsignedBigInteger('coupon_id')->nullable()->default(null);
            $table->foreign('coupon_id')->
            references('id')->
            on('coupons');

            $table->unsignedBigInteger('address_id')->nullable()->default(null);
            $table->foreign('address_id')->
            references('id')->
            on('addresses');

            $table->unsignedBigInteger('subtotal');
            $table->unsignedBigInteger('discount')->nullable()->default(null);
            $table->unsignedBigInteger('subtotal_less_discount');
            $table->unsignedBigInteger('tax_rate_id');
            $table->unsignedBigInteger('tax_rate');
            $table->unsignedBigInteger('total_tax_rate');
            $table->unsignedBigInteger('total');
            $table->enum('status', ['Processing', 'Pending Payment','On Hold','Failed','Completed','Cancelled','Refunded'])
                ->default('Pending Payment');;
            $table->timestamp('delivery_time')->nullable();
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->
            references('id')->
            on('orders')->
            onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->
            references('id')->
            on('products')->
            onDelete('cascade');

            $table->string('title');
            $table->string('product_num');
            $table->integer('quantity');

            $table->unsignedBigInteger('unit_price');
            $table->unsignedBigInteger('total');
            $table->primary(['order_id', 'product_id',]);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
};

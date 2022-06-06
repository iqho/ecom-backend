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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('order_status_id')->constrained('order_statuses')->cascadeOnUpdate()->restrictOnDelete();

            $table->string('order_number', 100)->unique();

            $table->text('shipping_address');
            $table->text('billing_address');

            $table->decimal('promo_discount_amount', 10, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->decimal('shipping_fee', 8, 2)->default(0);
            $table->decimal('item_sub_total', 10, 2);
            $table->decimal('grand_total', 10, 2);

            $table->tinyInteger('payment_method'); // COD, Mobile Banking, Bank Debit/Credit Card
            $table->tinyInteger('payment_status')->default(1); // Paid, Unpaid, Partials

            $table->timestamps();
            $table->softDeletesTz('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

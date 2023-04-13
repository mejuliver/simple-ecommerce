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
            $table->foreignIDFor(\App\Models\User::class)->nullable();
            $table->foreignIDFor(\App\Models\Coupon::class)->nullable();
            $table->foreignIDFor(\App\Models\Payment::class)->nullable();
            $table->foreignIDFor(\App\Models\Shipping::class)->nullable();
            $table->string('order_id',200)->nullable()->index();
            $table->longText('customer_json')->nullable();
            $table->longText('product_json')->nullable();
            $table->longText('payment_json')->nullable();
            $table->longText('coupon_json')->nullable();
            $table->longText('shipping_json')->nullable();
            $table->double('amount', 10, 2)->nullable();
            $table->enum('discount_type',['fixed','percent'])->nullable();
            $table->double('discount',10,2)->nullable();
            $table->enum('status',['processing','pending','cancelled','in complete','rejected','fail','hold','completed'])->nullable()->index();
            $table->enum('fullfillment',['processing','pending','cancelled','in complete','rejected','fail','hold','completed'])->nullable()->index();
            $table->integer('items')->nullable();
            $table->longText('json')->nullable();
            $table->tinyInteger('invoice_sent')->default(0)->index();
            $table->timestamp('invoice_sent_at')->nullable();
            $table->timestamp('invoice_last_sent_at')->nullable();
            $table->string('currency',20)->nullable();
            $table->string('notes',200)->nullable();
            $table->tinyInteger('is_active')->default(1)->index();
            $table->tinyInteger('is_deleted')->default(0)->index();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('product_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignIDFor(\App\Models\User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('return_id',200)->nullable()->index();
            $table->string('first_name',100)->index();
            $table->string('last_name',100)->nullable();
            $table->string('email',100)->index();
            $table->string('phone',100)->index()->nullable();
            $table->string('order_id',100)->nullable();
            $table->date('order_date')->nullable();
            $table->string('product_name',200)->nullable();
            $table->string('product_code',200)->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('reason_return',['dead on arrival','Faulty, please supply details','Order Error','Other, please supply details','Received Wrong Item'])->nullable();
            $table->tinyInteger('is_opened')->default(0)->index();
            $table->longText('details')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_returns');
    }
};

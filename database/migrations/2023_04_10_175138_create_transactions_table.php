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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIDFor(\App\Models\User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIDFor(\App\Models\Order::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('transaction_id',200)->nullable()->index();
            $table->double('amount', 10, 2)->nullable();
            $table->enum('status',['processing','pending','cancelled','in complete','rejected','fail','hold','completed'])->nullable()->index();
            $table->tinyInteger('is_paid')->default(0)->index();
            $table->timestamp('paid_at')->nullable();
            $table->double('paid_amount', 10, 2)->nullable();
            $table->longText('json')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};

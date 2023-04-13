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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIDFor(\App\Models\User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIDFor(\App\Models\Order::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('invoice_id',200)->nullable()->index();
            $table->string('slug',100)->nullable();
            $table->string('name',200)->index();
            $table->string('excerpt',100)->nullable();
            $table->longText('details')->nullable();
            $table->tinyInteger('invoice_sent')->default(0)->index();
            $table->timestamp('invoice_sent_at')->nullable();
            $table->longText('json')->nullable();
            $table->string('notes',200)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

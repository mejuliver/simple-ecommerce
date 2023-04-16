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
        Schema::create('gift_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignIDFor(\App\Models\User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('recipient_name',200)->nullable();
            $table->string('recipient_email',100)->index();
            $table->string('sender_name',200)->nullable();
            $table->string('sender_email',100)->index();
            $table->enum('type',['Birthday','Christmas','General']);
            $table->tinyInteger('is_sent')->default(0)->index();
            $table->tinyInteger('is_received')->default(0)->index();
            $table->timestamp('received_at')->nullable();
            $table->double('amount', 10, 2)->nullable();
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
        Schema::dropIfExists('gift_certificates');
    }
};

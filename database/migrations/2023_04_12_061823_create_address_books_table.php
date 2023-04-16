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
        Schema::create('address_books', function (Blueprint $table) {
            $table->id();
            $table->foreignIDFor(\App\Models\User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('addressbook_id',200)->nullable()->index();
            $table->string('first_name',200)->index();
            $table->string('middle_name',200)->nullable();
            $table->string('last_name',200);
            $table->string('email',100);
            $table->string('phone',80);
            $table->tinyInteger('is_billing')->default(0);
            $table->tinyInteger('is_shipping')->default(0);
            $table->string('company',200)->nullable();
            $table->mediumText('address1');
            $table->mediumText('address2')->nullable();
            $table->string('city',150);
            $table->string('post_code',30)->nullable();
            $table->string('country',150);
            $table->string('region_state',150);
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
        Schema::dropIfExists('address_books');
    }
};

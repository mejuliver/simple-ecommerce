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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIDFor(\App\Models\User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIDFor(\App\Models\Brand::class)->nullable();
            $table->foreignIDFor(\App\Models\Inventory::class);
            $table->foreignIDFor(\App\Models\Store::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIDFor(\App\Models\Manufacturer::class)->nullable();
            $table->string('product_id',200)->nullable()->index();
            $table->string('name',200)->index();
            $table->string('excerpt',100)->nullable();
            $table->string('slug',100)->nullable();
            $table->longText('details')->nullable();
            $table->double('price', 10, 2)->nullable();
            $table->double('special', 10, 2)->nullable();
            $table->enum('special_type',['fixed','percent'])->nullable();
            $table->date('special_start_date')->nullable();
            $table->date('special_end_date')->nullable();
            $table->enum('discount_type',['fixed','percent'])->nullable();
            $table->double('discount',10,2)->nullable();
            $table->string('currency',20)->nullable();
            $table->enum('product_type',['media','default'])->nullable()->index();
            $table->tinyInteger('accept_coupon')->default(1)->index();
            $table->tinyInteger('is_featured')->default(0)->index();
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
        Schema::dropIfExists('products');
    }
};

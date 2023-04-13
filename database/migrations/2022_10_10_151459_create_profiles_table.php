<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles',function(Blueprint $table){
            $table->id();
            $table->foreignIDFor(\App\Models\User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name',100)->index();
            $table->string('last_name',100)->nullable();
            $table->string('middle_name',100)->nullable();
            $table->string('suffix',10)->nullable();
            $table->string('email',100)->index();
            $table->string('mobile',100)->index()->nullable();
            $table->string('telephone',100)->index()->nullable();
            $table->string('fax',100)->nullable();
            $table->date('birthdate')->nullable()->index();
            $table->tinyInteger('age')->nullable();
            $table->mediumText('address1')->nullable();
            $table->mediumText('address2')->nullable();
            $table->string('city',55)->index()->nullable();
            $table->string('state',55)->nullable();
            $table->string('country',55)->index()->nullable();
            $table->string('country_code',10)->index()->nullable();
            $table->string('facebook_link',100)->nullable();
            $table->string('twitter_link',100)->nullable();
            $table->string('instagram_link',100)->nullable();
            $table->string('google_link',100)->nullable();
            $table->string('linkedin_link',100)->nullable();
            $table->string('currency',20)->nullable();
            $table->tinyInteger('is_active')->default(0)->index();
            $table->tinyInteger('is_deleted')->default(0)->index();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}

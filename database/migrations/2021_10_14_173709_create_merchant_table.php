<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('merchant_name')->unique();
            $table->text('description');
            $table->time('open_time');
            $table->time('close_time');
            $table->text('galery_merchant');
            $table->string('address_menchant');
            $table->enum('role', ['food', 'mart']);
            $table->boolean('status');
            $table->string('describe_verification')->default('');
            $table->timestamps();
            $table->index('merchant_name');	
            $table->index('role');	
            $table->index('open_time');
            $table->index('status');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('vehicle_type', ['car', 'motorcycle']);
            $table->string('vehicle_number')->unique();
            $table->integer('sim_number')->unique();
            $table->integer('ktp_number')->unique();
            $table->string('photo_user');
            $table->string('photo_ktp');
            $table->string('photo_sim');
            $table->string('photo_stnk');
            $table->boolean('status');
            $table->string('describe_verification')->default('');
            $table->timestamps();
            $table->index('vehicle_type');
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
        Schema::dropIfExists('driver');
    }
}

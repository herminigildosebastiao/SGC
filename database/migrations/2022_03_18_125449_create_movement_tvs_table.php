<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementTvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_tvs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('tv_provider_id')->unsigned();
            $table->string('decoder_number')->nullable();
            $table->decimal('amount', 8, 2);
            $table->text('description');
            $table->enum('status', [0, 1]);
            $table->bigInteger('service_id')->unsigned();
            $table->string('user_code', 11);
            $table->timestamps();

            $table->foreign('user_code')->references('code')->on('users');
            $table->foreign('tv_provider_id')->references('id')->on('tv_providers');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movement_tvs');
    }
}

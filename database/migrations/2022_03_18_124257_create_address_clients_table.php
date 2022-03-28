<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_code', 11);
            $table->bigInteger('address_type_id')->unsigned();
            $table->text('description');
            $table->bigInteger('district_id')->unsigned();
            $table->timestamps();

            $table->foreign('client_code')->references('code')->on('clients')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('address_type_id')->references('id')->on('address_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_clients');
    }
}

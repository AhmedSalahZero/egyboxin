<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodeCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_couriers', function (Blueprint $table) {
            $table->id();
            $table->string('barcode_number')->unique();
            $table->unsignedBigInteger('courier_id');
            $table->unsignedBigInteger('seller_id');

            $table->foreign('barcode_number')->references('barcode_number')->on('barcodes');
            $table->foreign('courier_id')->references('id')->on('users');
            $table->foreign('seller_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barcode_couriers');
    }
}

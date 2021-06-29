<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliverCourierIdToBarcodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barcodes', function (Blueprint $table) {
            $table->unsignedBigInteger('deliver_courier_id')->nullable();
            $table->foreign('deliver_courier_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barcodes', function (Blueprint $table) {
            //
        });
    }
}

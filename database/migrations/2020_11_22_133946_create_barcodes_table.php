<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('barcode_number')->unique();
            $table->string('client_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('price')->nullable();
            $table->string('content')->nullable();
            $table->enum('status', ['created', 'pending','received hub','out to deliver','delivered','RTO','canceled','reschedule','Returned','transfer'])->default('pending');
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
        Schema::dropIfExists('barcodes');
    }
}

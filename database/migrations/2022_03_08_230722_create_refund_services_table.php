<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refund_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('refund_id')->references('id')->on('refunds');
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
        Schema::dropIfExists('refund_services');
    }
};

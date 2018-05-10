<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpesaStkCallbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_stk_callbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MerchantRequestID')->index();
            $table->string('CheckoutRequestID')->index();
            $table->integer('ResultCode');
            $table->string('ResultDesc');
            $table->double('Amount', 10, 2)->nullable();
            $table->string('MpesaReceiptNumber')->nullable();
            $table->string('Balance')->nullable()->nullable();
            $table->string('TransactionDate')->nullable();
            $table->string('PhoneNumber')->nullable();
            $table->timestamps();
            $table->foreign('CheckoutRequestID')
                ->references('CheckoutRequestID')
                ->on('mpesa_stk_requests')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpesa_stk_callbacks');
    }
}

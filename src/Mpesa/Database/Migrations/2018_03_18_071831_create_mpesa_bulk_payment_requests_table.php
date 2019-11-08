<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpesaBulkPaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_bulk_payment_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('conversation_id')->index();
            $table->string('originator_conversation_id');
            $table->double('amount', 10, 2);
            $table->string('phone', 20);
            $table->string('remarks')->nullable();
            $table->string('CommandID')->default('BusinessPayment');
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('mpesa_bulk_payment_requests');
    }
}

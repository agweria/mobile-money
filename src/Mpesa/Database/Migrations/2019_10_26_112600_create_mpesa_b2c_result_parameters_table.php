<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaB2cResultParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_b2c_result_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('response_id');
            $table->decimal('TransactionAmount', 10, 2);
            $table->string('TransactionReceipt')->unique();
            $table->char('B2CRecipientIsRegisteredCustomer', 1);
            $table->bigInteger('B2CChargesPaidAccountAvailableFunds');
            $table->string('ReceiverPartyPublicName');
            $table->dateTime('TransactionCompletedDateTime');
            $table->decimal('B2CUtilityAccountAvailableFunds', 20, 2);
            $table->decimal('B2CWorkingAccountAvailableFunds', 20, 2);
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
        Schema::dropIfExists('mpesa_b2c_result_parameters');
    }
}

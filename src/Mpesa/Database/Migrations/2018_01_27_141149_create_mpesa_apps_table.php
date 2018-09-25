<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpesaAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_apps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_code');
            $table->string('company')->nullable();
            $table->enum('environment', ['sandbox', 'production'])->default('sandbox');
            $table->string('consumer_key');
            $table->string('consumer_secret');
            $table->string('passkey')->nullable();
            $table->string('initiator_name')->nullable();
            $table->string('initiator_credentials')->nullable();
            $table->string('type')->default('c2b');
            $table->boolean('default')->default(false);
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
        Schema::dropIfExists('mpesa_apps');
    }
}

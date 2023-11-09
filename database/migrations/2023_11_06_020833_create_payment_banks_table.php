<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('account_name'); // Added account_name field
            $table->string('bank_account'); // Renamed to bank_account (account number)
            $table->string('bank_image_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_banks');
    }
};

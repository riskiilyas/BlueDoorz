<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();
            $table->unsignedBigInteger('branch_address_id'); // Foreign key
            $table->foreign('type_id')->references('id')->on('room_types')->onDelete('cascade');
            $table->foreign('branch_address_id')->references('id')->on('branch_addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};

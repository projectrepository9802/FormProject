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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_pelanggan');
            $table->string('name');
            $table->text('address');
            $table->enum('class', ['Personal', 'Bussiness']);
            $table->string('email');
            $table->string('identity_number');
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_npwp')->nullable();
            $table->string('company_employees')->nullable();
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
        Schema::dropIfExists('customers');
    }
};

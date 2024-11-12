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
        Schema::table('re_registrations', function (Blueprint $table) {
            $table->enum('status', ['PROSES', 'VALID', 'FAILED'])->default('PROSES');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('re_registrations', function (Blueprint $table) {
            //
        });
    }
};

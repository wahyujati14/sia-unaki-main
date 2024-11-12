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
        Schema::table('user_initial_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('certificate_receive_id')->nullable();
        });
        Schema::table('user_health_contributions', function (Blueprint $table) {
            $table->unsignedBigInteger('certificate_receive_id')->nullable();
        });
        Schema::table('user_kemahasiswaan_contributions', function (Blueprint $table) {
            $table->unsignedBigInteger('certificate_receive_id')->nullable();
        });
        Schema::table('user_library_contributions', function (Blueprint $table) {
            $table->unsignedBigInteger('certificate_receive_id')->nullable();
        });
        Schema::table('user_discount_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('certificate_receive_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

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
        Schema::table('information_services', function (Blueprint $table) {
            $table->bigInteger('initial_payment')->default(2000000);
            $table->bigInteger('health_payment')->default(100000);
            $table->bigInteger('kemahasiswaan_contribution')->default(200000);
            $table->bigInteger('library_contribution')->default(50000);
            $table->bigInteger('ematerai')->default(25000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('information_services', function (Blueprint $table) {
            //
        });
    }
};

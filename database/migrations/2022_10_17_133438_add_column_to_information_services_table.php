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
            $table->bigInteger('institute_development_contribution_reguler')->default(0);
            $table->bigInteger('institute_development_contribution')->default(0);
            $table->bigInteger('education_construction_contribution')->default(0);
            $table->bigInteger('sks')->default(0);
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

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
        Schema::table('certificate_receives', function (Blueprint $table) {
            $table->dropColumn('registration_periode_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_receives', function (Blueprint $table) {
            $table->unsignedBigInteger('registration_periode_id')->nullable();
        });
    }
};

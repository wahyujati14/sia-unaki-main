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
        Schema::create('information_services', function (Blueprint $table) {
            $table->id();
            $table->string('email')->default('cs@unaki.ac.id');
            $table->string('whatsapp')->default('081 829 0000');
            $table->string('phone')->default('(024) 3552 555');
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
        Schema::dropIfExists('information_services');
    }
};

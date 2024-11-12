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
        Schema::create('certificate_receives', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_certificate')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('registration_periode_id')->nullable();
            $table->unsignedBigInteger('study_program_id')->nullable();
            $table->integer('submission')->default(0);
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
        Schema::dropIfExists('certificate_receives');
    }
};

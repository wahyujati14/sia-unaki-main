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
        Schema::create('study_result_card_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('study_result_card_id');
            $table->unsignedBigInteger('user_class_course_id');
            $table->unsignedBigInteger('course_id');
            $table->string('letter_value');
            $table->integer('score');
            $table->softDeletes();
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
        Schema::dropIfExists('study_result_card_scores');
    }
};

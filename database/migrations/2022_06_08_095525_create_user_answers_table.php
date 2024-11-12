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
        Schema::create('exam_user_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_user_session_id');
            $table->unsignedBigInteger('exam_answer_id');
            $table->unsignedBigInteger('exam_question_id');
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
        Schema::dropIfExists('exam_user_answers');
    }
};

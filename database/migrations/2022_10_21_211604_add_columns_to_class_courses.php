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
        Schema::table('class_courses', function (Blueprint $table) {
            $table->tinyInteger('credit_course_hourly')->nullable();
            $table->tinyInteger('credit_course_payment')->nullable();

            $table->tinyInteger('presence_weight')->default(0);
            $table->tinyInteger('quiz_weight')->default(0);
            $table->tinyInteger('task_weight')->default(0);
            $table->tinyInteger('tts_weight')->default(0);
            $table->tinyInteger('tas_weight')->default(0);
            $table->enum('scoring_system', ['PAP', 'PAN'])->default('PAP');
            $table->tinyInteger('avg_score')->default(0);
            $table->tinyInteger('deviation')->default(0);
            $table->tinyInteger('valid_score')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_courses', function (Blueprint $table) {
            $table->dropColumn('credit_course_hourly');
            $table->dropColumn('credit_course_payment');

            $table->dropColumn('presence_weight');
            $table->dropColumn('quiz_weight');
            $table->dropColumn('task_weight');
            $table->dropColumn('tts_weight');
            $table->dropColumn('tas_weight');
            $table->dropColumn('scoring_system');
            $table->dropColumn('avg_score');
            $table->dropColumn('deviation');
            $table->dropColumn('valid_score');
        });
    }
};

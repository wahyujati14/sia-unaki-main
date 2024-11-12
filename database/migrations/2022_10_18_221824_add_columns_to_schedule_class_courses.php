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
        Schema::table('schedule_class_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->after('class_course_id');
            $table->string('code')->after('room_id');
            $table->integer('quota')->after('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_class_courses', function (Blueprint $table) {
            //
        });
    }
};

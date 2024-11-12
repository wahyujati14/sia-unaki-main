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
        Schema::table('study_result_cards', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->integer('actual_score')->default(0);
            $table->string('letter_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('study_result_cards', function (Blueprint $table) {
            $table->dropColumn(['actual_score','letter_value']);
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }
};

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
        Schema::table('user_file_uploads', function (Blueprint $table) {
            $table->string('file_name');
            $table->string('file_type');
            $table->dropColumn('file_upload_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_file_uploads', function (Blueprint $table) {
            //
        });
    }
};

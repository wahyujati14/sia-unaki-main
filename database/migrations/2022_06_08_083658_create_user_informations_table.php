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
        Schema::create('user_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('religion_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('sub_district_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('registration_path_id')->nullable();
            $table->unsignedBigInteger('registration_periode_id')->nullable();
            $table->string('birth_place')->default('');
            $table->date('birth');
            $table->boolean('is_work')->default(false);
            $table->enum('last_education', ['SMA', 'SMK', 'D3'])->nullable();
            $table->enum('gender', ['MALE', 'FEMALE']);
            $table->string('parent_name');
            $table->string('biological_mother');
            $table->string('parent_phone');
            $table->text('parent_address');
            $table->text('identity_address');
            $table->text('current_address');
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
        Schema::dropIfExists('user_informations');
    }
};

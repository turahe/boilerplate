<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('alias')->nullable();
            $table->boolean('gender')->nullable()
                ->comment('true is female (because women are always right) and false male');
            $table->string('birthplace')->nullable();
            $table->date('birthday')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('number_personnel')->nullable();
            $table->string('number_citizen')->nullable();
            $table->string('number_taxpayer')->nullable();
            $table->string('number_passport')->nullable();
            $table->string('hobby')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('size_shoes')->nullable();
            $table->integer('size_shirt')->nullable();
            $table->integer('size_pants')->nullable();
            $table->string('blood')->nullable();
            $table->string('eyes')->nullable();
            $table->string('rhesus')->nullable();
            $table->text('biography')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}

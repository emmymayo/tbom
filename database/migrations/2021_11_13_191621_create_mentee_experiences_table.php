<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenteeExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentee_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentee_id')->constrained();
            $table->string('school');
            $table->year('from')->nullable();
            $table->year('to')->nullable();
            $table->string('degree')->nullable();
            $table->string('area_of_study')->nullable();
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('mentee_experiences');
    }
}

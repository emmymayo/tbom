<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorExpertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_expertises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained();
            $table->foreignId('expertise_id')->constrained();
            $table->tinyInteger('years_of_experience')->default(1);
            $table->string('duration_of_mentorship')->default('One year');
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
        Schema::dropIfExists('mentor_expertises');
    }
}

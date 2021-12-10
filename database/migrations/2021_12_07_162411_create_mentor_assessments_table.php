<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained();
            $table->foreignId('mentee_id')->constrained();
            $table->tinyInteger('expertise')->default(1);
            $table->tinyInteger('availability')->default(1);
            $table->tinyInteger('motivation')->default(1);
            $table->tinyInteger('listening')->default(1);
            $table->tinyInteger('adaptability')->default(1);
            $table->tinyInteger('positivity')->default(1);
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
        Schema::dropIfExists('mentor_assessments');
    }
}

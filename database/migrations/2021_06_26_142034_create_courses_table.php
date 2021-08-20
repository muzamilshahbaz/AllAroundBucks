<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');

            $table->string('trainer');

            $table->foreign('trainer')->references('trainer_username')->on('trainers')->onUpdate('cascade')->onDelete('cascade');
                $table->unsignedBigInteger('trainer_id');
              $table->foreign('trainer_id')->references('trainer_id')->on('trainers')->onUpdate('cascade')->onDelete('cascade');
              $table->string('course_title');
              $table->string('course_description');

              $table->string('course_duration');
              $table->string('course_price');
              $table->string('course_img');
              $table->string('course_videos')->nullable();
                $table->string('course_category');
              $table->unsignedBigInteger('category_id');
              $table->foreign('category_id')->references('category_id')->on('categories')->onUpdate('cascade')->onDelete('cascade');

             // $table->integer('course_videos')->nullable();
              $table->float('rating')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

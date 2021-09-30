<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('project_id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('paid_project_id');
            $table->foreign('paid_project_id')->references('id')->on('paid_projects')->onUpdate('cascade')->onDelete('cascade');
            // $table->string('token');
            $table->string('card_number');
            $table->integer('cvc');
            $table->string('card_holder');
            $table->dateTime('exp_month');
            $table->dateTime('exp_year');
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
        Schema::dropIfExists('project_payments');
    }
}

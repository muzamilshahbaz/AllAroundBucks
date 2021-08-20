<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('project_id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('proposal_id');
            $table->foreign('proposal_id')->references('proposal_id')->on('proposals')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')->references('buyer_id')->on('buyers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('seller_id')->on('sellers')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('duration');
            $table->string('duration_format');
            $table->integer('price');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('paid_projects');
    }
}

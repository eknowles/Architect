<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('location');
            $table->string('client');
            $table->boolean('public')->default(false);
            $table->string('photo')->nullable();
            $table->string('size')->nullable();
            $table->date('completed')->nullable();
            $table->longText('description');
            $table->string('keywords');
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
        Schema::drop('projects');
    }
}

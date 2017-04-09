<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->boolean('is_task');
            $table->boolean('contains_document');
            $table->dateTime('start_date');
            $table->dateTime('ending_date'); 
            $table->enum('importance', ['low', 'middle', 'high', 'urgent'])->default('middle');//ENUM['low', 'middle', 'high', 'urgent'] ->default: 'middle'
            $table->integer('responsible_id')->unsigned();//The person in charge of doing the task
            $table->integer('creator_id')->unsigned();//The person that created the task
            $table->integer('category_id')->unsigned();

            $table->foreign('responsible_id')->references('id')->on('users');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            
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
        Schema::drop('articles');
    }
}

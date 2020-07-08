<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('picture')
                ->nullable();
            $table->foreignId('recipe_category_id')
                ->constrained()
                ->onDelete('cascade');
            $table->unsignedSmallInteger('prepare_time');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->unsignedTinyInteger('serves');
            $table->boolean('verified')
                ->default(false);
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
        Schema::dropIfExists('recipes');
    }
}

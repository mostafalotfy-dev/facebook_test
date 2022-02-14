<?php

use App\Models\HashTag;
use App\Models\Recipe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeHashtagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_hashtag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Recipe::class)->references("id")->on("recipes")->cascadeOnDelete();
            $table->foreignIdFor(HashTag::class)->references("id")->on("hashtags")->cascadeOnDelete();
            
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_hashtag');
    }
}

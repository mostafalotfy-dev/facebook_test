<?php

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes_album', function (Blueprint $table) {
            $table->id();
            $table->string("file_name");
            $table->string("mime_type");
            $table->foreignIdFor(Recipe::class)->references("id")->on("recipes")->onDelete("cascade")->nullable();
            $table->foreignIdFor(User::class)->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('recipes_album');
    }
}

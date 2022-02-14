<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\HashTag;
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
        
            $table->string("title");
            $table->string("description");
            $table->foreignIdFor(User::class)->references("id")->on("users")->onDelete("cascade");
            $table->foreignIdFor(HashTag::class)->references("id")->on("hashtags")->onDelete("cascade");
            $table->foreignIdFor(Category::class)->references("id")->on("categories")->onDelete("cascade");
            $table->unsignedBigInteger("people_count");
            $table->string("cooking_time");
            $table->unsignedTinyInteger("is_active");
            $table->softDeletes();
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

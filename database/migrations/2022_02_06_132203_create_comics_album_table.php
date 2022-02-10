<?php

use App\Models\Comic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComicsAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comics_album', function (Blueprint $table) {
            $table->id();
            $table->string("file_name");
            $table->string("mime_type");
            $table->foreignIdFor(Comic::class)->references("id")->on("comics")->onDelete("cascade")->nullable();
            $table->morphs("user");
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
        Schema::dropIfExists('comics_album');
    }
}

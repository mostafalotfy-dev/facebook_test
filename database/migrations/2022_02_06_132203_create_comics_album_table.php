<?php

use App\Models\Comic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
        Schema::dropIfExists('comics_album');
    }
}

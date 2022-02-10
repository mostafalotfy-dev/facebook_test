<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheifs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->unique();
  
            $table->string("verify_number");
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->string('password');
            $table->string("avatar")->default("avatar.png");
            $table->unsignedInteger("provider_id")->nullable()->index();
            $table->string("provider_token")->nullable();
            $table->string("provider_name")->nullable();
            $table->string("identity")->default("identity.png");
            $table->string("description")->nullable();
            $table->ipAddress("user_ip");
            $table->string("address")->nullable();
            $table->string("youtube_channel")->nullable();
            $table->string("facebook_link")->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('cheifs');
    }
}

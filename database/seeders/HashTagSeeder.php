<?php

namespace Database\Seeders;

use App\Models\HashTag;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Comic;
class HashTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        HashTag::truncate();
        HashTag::create([
            "title"=> "#hashtag",
            "user_id"=> User::all()->random(1)->first()->id,
            "postable_type"=> Recipe::class,
            "postable_id"=>Recipe::all()->random(1)->first()->id,
        ]);
        // HashTag::create([
        //     "title"=> "#hashtag",
        //     "user_id"=> User::all()->random(1)->first()->id,
        //     "postable_type"=> Comic::class,
        //     "postable_id"=>Comic::all()->random(1)->first()->id,
        // ]);
        Schema::enableForeignKeyConstraints();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Recipe::truncate();
        Recipe::insert([
            [
                "title" => "وصفة جديدة",
                "description" => "وصفة يتم استخدامها بشكل متكرر في ايطاليا",
                "created_by"=>1,
                "category_id" => 1,
                'people_count' => 5,
                "cooking_time" => "4:00",
                "is_active"=>1,
                "hash_tag_id"=>1
            ],
            [
                "title" => "وصفة جديدة",
                "description" => "وصفة يتم استخدامها بشكل متكرر في ايطاليا",
               
                "category_id" => 1,
                'people_count' => 5,
                "cooking_time" => "4:00",
                "is_active"=>0,
                "hash_tag_id"=>1,
                "created_by"=>1
            ]

        ]);
        Schema::enableForeignKeyConstraints();
    }
}

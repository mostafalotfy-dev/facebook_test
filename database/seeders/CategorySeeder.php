<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Category::insert([
            [
                "name_en"=>"BBQ",
                "name_ar"=>"مشويات",
                "created_by"=>1,

            ],
            [
                "name_en"=>"Sugars",
                "name_ar"=>"سكريات",
                "created_by"=>1,
            ],
            [
                "name_en"=>"Vegetables",
                "name_ar"=>"خضروات",
                "created_by"=>1
            ],
            [
                "name_en"=>"Pastries",
                "name_ar"=>"معجنات",
                "created_by"=>1,
            ],
        ]);
        Schema::enableForeignKeyConstraints();
    }
}

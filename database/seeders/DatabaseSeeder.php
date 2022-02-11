<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HashTag;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(HashTagSeeder::class);
        
    }
}

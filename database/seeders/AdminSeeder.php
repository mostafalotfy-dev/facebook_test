<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Schema::disableForeignKeyConstraints();
       Admin::truncate();
       Admin::create([
            "first_name"=>"developer",
            "last_name"=>"develop",
            "email"=>"admin@foodcode.com",
            "password"=>bcrypt("first#in@last@_out")
        ]);
       Schema::enableForeignKeyConstraints();

    }
}

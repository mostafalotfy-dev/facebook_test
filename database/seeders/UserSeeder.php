<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        User::create([
            "name"=>"developer",
            "phone_number"=>"01021408852",
            "password"=>bcrypt("first_@user#last"),
            "verify_number"=>rand(10000,9999),
            'user_ip'=>"0.0.0.0"
        ]);
        
        Schema::enableForeignKeyConstraints();
    }
    
}

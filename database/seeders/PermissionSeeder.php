<?php

namespace Database\Seeders;
use App\Models\Admin;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;
// Use This Class For Permissions
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Permission::truncate();
        
        if (!Role::where("name", "super-admin")->exists()) {
            $role = new Role([
                "name" => "super-admin",
                "guard_name" => "admin"
            ]);

            $role->save();
        } else {
            $role = Role::where("name", "super-admin")->first();

        }
        $custom = [
            [
                "name" => "activate-admin",
            ]
            , [
                'name' => "deactivate-admin",

            ],
            [
                'name' => "reset-password",

            ], [
                'name' => "activate-notification",

            ],
            [
                'name' => "deactivate-notification",

            ],
            [
                "name" => "view-reports"
            ],
        ];
        $permissions = [

            "role",


            "admin",


            "notification",


            "logs",

            "city",


            "govern",

           


            "admins",


            "clients",


            "roles",

            "notification",
         
           
              
               "setting",
               
              
              
           
            

        ];

        foreach ($permissions as $p) {
            foreach (["view", "add", "delete", "update"] as $option) {
                if (!Permission::where("name", $option . "-" . $p)->exists()) {
                    $permission = new Permission();
                    $permission->name = "$option-" . $p;
                    $permission->guard_name = "admin";
                    $permission->save();

                    dump("added $permission->name");
                }
            }
        }

        foreach ($custom as $c) {
            dump($c["name"]);
            if(Permission::where("name",$c["name"])->exists())
            {
                continue;
            }
            $permission = new Permission();
            $permission->name = $c["name"];
            $permission->guard_name = "admin";
            $permission->save();
        }

        $role->givePermissionTo(Permission::all());


        if ($admin = Admin::where("id", 1)->first()) {
           
            $admin->roles()->save($role);
            return;
        }
        $admin->assignRole($role);
        Schema::enableForeignKeyConstraints();
    }
}

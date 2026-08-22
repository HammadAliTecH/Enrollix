<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $permissions = [ "student_managment" , "course_managment" ,
                         "users_managment"   , "privileges_managment" ,
                         "finance_managment"];

        foreach($permissions as $value)
            {
              Permission::create(['name' => $value ]);
            }
    }
}

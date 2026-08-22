<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     $array=["super_admin" , "admin" , "hr" , "teacher"];
        foreach( $array as $value){
           Role::create([
            "name" => $value
           ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin =Role::find(1);
        $admin =Role::find(2);
        $hr = Role::find(3);
        $teacher = Role::find(4);

        $super_admin->permissions()->sync([1,2,3,4,5]);
        $admin->permissions()->sync([1,2,5]);
        $hr->permissions()->sync([1,5]);
        $teacher->permissions()->sync([2]);


    }
}

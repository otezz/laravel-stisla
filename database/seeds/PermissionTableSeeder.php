<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev_role = Role::where('slug', 'developer')->first();
        $manager_role = Role::where('slug', 'manager')->first();

        $deleteUsers = new Permission();
        $deleteUsers->slug = 'delete-users';
        $deleteUsers->name = 'Delete Users';
        $deleteUsers->save();
        $deleteUsers->roles()->attach($dev_role);

        $editUsers = new Permission();
        $editUsers->slug = 'edit-users';
        $editUsers->name = 'Edit Users';
        $editUsers->save();
        $editUsers->roles()->attach($manager_role);
    }
}

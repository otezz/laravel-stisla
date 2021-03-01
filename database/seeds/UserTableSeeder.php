<?php

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
        $dev_perm = Permission::where('slug', 'create-tasks')->first();
        $manager_perm = Permission::where('slug', 'delete-users')->first();

        $developer = new User();
        $developer->name = 'Usama Muneer';
        $developer->email = 'dev@example.com';
        $developer->password = bcrypt('secret');
        $developer->save();
        $developer->roles()->attach($dev_role);
        $developer->permissions()->attach($dev_perm);


        $manager = new User();
        $manager->name = 'Asad Butt';
        $manager->email = 'manager@example.com';
        $manager->password = bcrypt('secret');
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm);
    }
}

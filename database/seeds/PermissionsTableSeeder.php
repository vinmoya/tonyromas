<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = 
        [
            'dashboard',
            'users',
            'restaurants',
            'codes',
            'users-edit-profile'
        ];
        foreach ($permissions as $permission) 
        {
            Permission::create(['name' => $permission]);
        }

        //////////////////Create Role Admin//////////////////
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'dashboard',
            'users',
            'restaurants',
            'codes',
            'users-edit-profile'
        ]);

        //////////////////Create Role User//////////////////
        $user = Role::create(['name' => 'User']);
        $user->givePermissionTo([
            'dashboard',
            'codes',
            'users-edit-profile',
        ]);

        //Assign Role Admin
        $user = User::find(1);
        $user->assignRole('Admin');

        //Asign Role User
        $user = User::find(2);
        $user->assignRole('User');

        //Assign Role Admin 2
        $user = User::find(3);
        $user->assignRole(Role::find(1));
    }
}

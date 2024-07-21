<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'phone_number'=>'023 220 097',
            'password'=>bcrypt('password'),
            'profile' => 'user.avif'
        ]);

        $writer = User::create([
            'name'=>'User',
            'email'=>'user@gmail.com',
            'phone_number'=>'012 786 688',
            'password'=>bcrypt('password')
        ]);

        $writer1 = User::create([
            'name'=>'Dany',
            'email'=>'dany@gmail.com',
            'phone_number'=>'012 389 989',
            'password'=>bcrypt('password')
        ]);



        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'user']);

        $permission = Permission::create(['name' => 'Post access']);
        $permission = Permission::create(['name' => 'Post edit']);
        $permission = Permission::create(['name' => 'Post create']);
        $permission = Permission::create(['name' => 'Post delete']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        $permission = Permission::create(['name' => 'Create_brance access']);
        $permission = Permission::create(['name' => 'Create_brance edit']);
        $permission = Permission::create(['name' => 'Create_brance create']);
        $permission = Permission::create(['name' => 'Create_brance delete']);

        $permission = Permission::create(['name' => 'Dashboard_admin access']);
        $permission = Permission::create(['name' => 'Dashboard_admin edit']);
        $permission = Permission::create(['name' => 'Dashboard_admin create']);
        $permission = Permission::create(['name' => 'Dashboard_admin delete']);

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);

        $permission = Permission::create(['name' => 'Chat access']);
        $permission = Permission::create(['name' => 'Chat admin']);
        $permission = Permission::create(['name' => 'Chat user']);


        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);
        $writer1->assignRole($writer_role);

        $admin_role->givePermissionTo(Permission::all());
    }
}

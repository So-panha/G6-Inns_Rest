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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '023 220 097',
            'password' => bcrypt('password'),
            'profile' => '/images/Profile.jpg',
        ]);

        $writer1 = User::create([
            'name' => 'Sopanha',
            'email' => 'sopanha@gmail.com',
            'phone_number' => '012 786 688',
            'password' => bcrypt('password'),
            'profile' => '/images/Profile.jpg',
        ]);

        $writer2 = User::create([
            'name' => 'Dany',
            'email' => 'dany@gmail.com',
            'phone_number' => '012 389 989',
            'password' => bcrypt('password'),
            'profile' => '/images/Profile.jpg',
        ]);

        $writer3 = User::create([
            'name' => 'Vanny',
            'email' => 'vanny@gmail.com',
            'phone_number' => '012 449 989',
            'password' => bcrypt('password'),
            'profile' => '/images/Profile.jpg',
        ]);

        $writer4 = User::create([
            'name' => 'Vichika',
            'email' => 'vichika@gmail.com',
            'phone_number' => '097 389 989',
            'password' => bcrypt('password'),
            'profile' => '/images/Profile.jpg',
        ]);

        $writer5 = User::create([
            'name' => 'Manny',
            'email' => 'manny@gmail.com',
            'phone_number' => '011 589 779',
            'password' => bcrypt('password'),
            'profile' => '/images/Profile.jpg',
        ]);

        $writer6 = User::create([
            'name' => 'Chen',
            'email' => 'chen@gmail.com',
            'phone_number' => '012 189 989',
            'password' => bcrypt('password'),
            'profile' => '/images/Profile.jpg',
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


        $permission = Permission::create(['name' => 'Dashboard access']);
        $permission = Permission::create(['name' => 'Dashboard_admin access']);
        $permission = Permission::create(['name' => 'Dashboard_service access']);

        $permission = Permission::create(['name' => 'Check_transaction access']);

        $permission = Permission::create(['name' => 'Request_account_service access']);
        $permission = Permission::create(['name' => 'Request_account_service create']);

        $permission = Permission::create(['name' => 'Check_account_request access']);
        $permission = Permission::create(['name' => 'Check_account_request edit']);
        $permission = Permission::create(['name' => 'Check_account_request create']);
        $permission = Permission::create(['name' => 'Check_account_request delete']);

        $permission = Permission::create(['name' => 'Check_booking access']);
        $permission = Permission::create(['name' => 'Check_booking edit']);
        $permission = Permission::create(['name' => 'Check_booking create']);
        $permission = Permission::create(['name' => 'Check_booking delete']);

        $permission = Permission::create(['name' => 'Check_room access']);
        $permission = Permission::create(['name' => 'Check_room edit']);
        $permission = Permission::create(['name' => 'Check_room create']);
        $permission = Permission::create(['name' => 'Check_room delete']);

        $permission = Permission::create(['name' => 'history access']);
        $permission = Permission::create(['name' => 'history edit']);
        $permission = Permission::create(['name' => 'history create']);
        $permission = Permission::create(['name' => 'history delete']);

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);

        $permission = Permission::create(['name' => 'Chat access']);
        $permission = Permission::create(['name' => 'Chat admin']);
        $permission = Permission::create(['name' => 'Chat user']);


        $admin->assignRole($admin_role);
        $writer1->assignRole($writer_role);
        $writer2->assignRole($writer_role);
        $writer3->assignRole($writer_role);


        // Set specific permissions to the user
        $admin_role->givePermissionTo([
            'Chat access',
            'Chat admin',

            'Dashboard access',
            'Dashboard_admin access',

            'Mail access',
            'Mail edit',

            'Check_transaction access',

            'Permission access',
            'Permission create',
            'Permission edit',
            'Permission delete',

            'Check_account_request access',
            'Check_account_request create',
            'Check_account_request edit',
            'Check_account_request delete',

            'User access',
            'User create',
            'User edit',
            'User delete',

            'Role access',
            'Role create',
            'Role edit',
            'Role delete',

            'Post access',
            'Post create',
            'Post edit',
            'Post delete',
        ]);

        // Set specific permissions to the user
        $writer1->givePermissionTo([

            'Chat access',
            'Chat user',

            'Dashboard access',
            'Dashboard_service access',

            'Mail access',
            'Mail edit',

            'Create_brance access',
            'Create_brance create',
            'Create_brance edit',
            'Create_brance delete',

            'Check_booking access',
            'Check_booking create',
            'Check_booking edit',
            'Check_booking delete',

            'Check_room access',
            'Check_room create',
            'Check_room edit',
            'Check_room delete',

            'history access',
            'history create',
            'history edit',
            'history delete',
        ]);

        // Set specific permissions to the user
        $writer2->givePermissionTo([

            'Chat access',
            'Chat user',

            'Dashboard access',
            'Dashboard_service access',

            'Mail access',
            'Mail edit',

            'Create_brance access',
            'Create_brance create',
            'Create_brance edit',
            'Create_brance delete',

            'Check_booking access',
            'Check_booking create',
            'Check_booking edit',
            'Check_booking delete',

            'Check_room access',
            'Check_room create',
            'Check_room edit',
            'Check_room delete',

            'history access',
            'history create',
            'history edit',
            'history delete',
        ]);

        // Set specific permissions to the user
        $writer3->givePermissionTo([

            'Chat access',
            'Chat user',

            'Dashboard access',
            'Dashboard_service access',

            'Mail access',
            'Mail edit',

            'Create_brance access',
            'Create_brance create',
            'Create_brance edit',
            'Create_brance delete',

            'Check_booking access',
            'Check_booking create',
            'Check_booking edit',
            'Check_booking delete',

            'Check_room access',
            'Check_room create',
            'Check_room edit',
            'Check_room delete',

            'history access',
            'history create',
            'history edit',
            'history delete',
        ]);

        // Set specific permissions to the user
        $writer4->givePermissionTo([

            'Chat access',
            'Chat user',

            'Dashboard access',
            'Dashboard_service access',

            'Mail access',
            'Mail edit',

            'Create_brance access',
            'Create_brance create',
            'Create_brance edit',
            'Create_brance delete',

            'Check_booking access',
            'Check_booking create',
            'Check_booking edit',
            'Check_booking delete',

            'Check_room access',
            'Check_room create',
            'Check_room edit',
            'Check_room delete',

            'history access',
            'history create',
            'history edit',
            'history delete',
        ]);

        // Set specific permissions to the user
        $writer5->givePermissionTo([

            'Chat access',
            'Chat user',

            'Dashboard access',
            'Dashboard_service access',

            'Mail access',
            'Mail edit',

            'Create_brance access',
            'Create_brance create',
            'Create_brance edit',
            'Create_brance delete',

            'Check_booking access',
            'Check_booking create',
            'Check_booking edit',
            'Check_booking delete',

            'Check_room access',
            'Check_room create',
            'Check_room edit',
            'Check_room delete',

            'history access',
            'history create',
            'history edit',
            'history delete',
        ]);

        // Set specific permissions to the user
        $writer6->givePermissionTo([

            'Chat access',
            'Chat user',

            'Dashboard access',
            'Dashboard_service access',

            'Mail access',
            'Mail edit',

            'Create_brance access',
            'Create_brance create',
            'Create_brance edit',
            'Create_brance delete',

            'Check_booking access',
            'Check_booking create',
            'Check_booking edit',
            'Check_booking delete',

            'Check_room access',
            'Check_room create',
            'Check_room edit',
            'Check_room delete',

            'history access',
            'history create',
            'history edit',
            'history delete',
        ]);
        // $admin_role->givePermissionTo(Permission::all());
    }
}

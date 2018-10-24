<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //secure seeder running
        $this->command->error('You are about to erase all users and roles!');

        $password_match = false;

        if ($this->command->confirm('Do you wish to continue?'))
        {
            $password = $this->command->secret('Enter authorisation code');

            if (config('seeders.users_table') == $password && config('seeders.users_table') != '')
            {
                $password_match = true;
            }
            else
            {
                $this->command->error('Wrong password, procedure aborted.');
            }
        }

        //run seeder
        if ($password_match)
        {
            DB::table('users')->truncate();
            DB::table('roles')->truncate();
            DB::table('role_users')->truncate();
            DB::table('activations')->truncate();

            // admin role template
            $admin_role = [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'permissions' => [
                    'admin' => true,
                ]
            ];

            // save role
            Sentinel::getRoleRepository()->createModel()->fill($admin_role)->save();

            // client template
            $client_role = [
                'name'        => 'Client',
                'slug'        => 'client',
                'permissions' => [
                    'client' => true,
                ]
            ];

            // save client role
            Sentinel::getRoleRepository()->createModel()->fill($client_role)->save();

            // build an array with admins
            $admins = [

                [
                    'email'      => 'robu.edi@gmail.com',
                    'password'   => '6EqnvRzJVmAxZmGrJxBN',
                    'first_name' => "Eduard",
                    'last_name'  => "Robu",
                    'permissions'=> [
                        'user.admin.view'           => true,
                        'user.admin.create'         => true,
                        'user.admin.edit'           => true,
                        'user.admin.delete'         => true,
                        'user.admin.deactivate_user'   => true,
                        'user.client.view'          => true,
                        'user.client.create'        => true,
                        'user.client.edit'          => true,
                        'user.client.delete'        => true,
                        'user.client.deactivate_user'  => true,
                    ]
                ],

                [
                    'email'      => 'edi_cristi3@yahoo.com',
                    'password'   => 'jyIIop9BUtLYzpx65qAM',
                    'first_name' => "Eduard",
                    'last_name'  => "Robu",
                    'permissions'=> [
                        'user.client.view'   => true,
                        'user.client.create' => true,
                        'user.client.edit'   => true,
                    ]
                ]
            ];

            // get admin role
            $admin_role          = Sentinel::findRoleBySlug('admin');

            foreach ($admins as $admin)
            {
                // register and activate admin user
                $admin_user = Sentinel::registerAndActivate($admin);
                $admin_user->save();

                // assign admin user to admin role
                $admin_role->users()->attach($admin_user);
            }

            $this->command->error(count($admins).' admins added. ');
        }
    }
}

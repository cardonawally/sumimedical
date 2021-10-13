<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'      =>  'Daniel',
                'last_name' =>  'Correa',
                'phone'     =>  23445673,
                'email'     =>  'drr@m.com',
                'password'  => bcrypt('password')
            ],
            [
                'name'      =>  'pedro',
                'last_name' =>  'Correa',
                'phone'     =>  23435673,
                'email'     =>  'pd@m.com',
                'password'  => bcrypt('password')
            ],
            [
                'name'      =>  'juan',
                'last_name' =>  'Correa',
                'phone'     =>  23456735,
                'email'     =>  'jd@m.com',
                'password'  => bcrypt('password')
            ],
            [
                'name'      =>  'luci',
                'last_name' =>  'Correa',
                'phone'     =>  2345673,
                'email'     =>  'dx@m.com',
                'password'  => bcrypt('password')
            ],
        ];

        $roles = [
            [
                'name' => 'admin',
                'user_id' => 1
            ],
            [
                'name' => 'user',
                'user_id' => 2
            ],
            [
                'name' => 'pintor',
                'user_id' => 3
            ],
            [
                'name' => 'gerente',
                'user_id' => 4
            ],
        ];

        $permissions = [
            [
                'name'  =>  'leer'
            ],
            [
                'name'  =>  'escribir'
            ],
            [
                'name'  =>  'eliminar'
            ],
            [
                'name'  =>  'editar'
            ],
        ];


        collect($users)->each(function ($user){ User::create($user); });
        collect($permissions)->each(function ($permission){ Permission::create($permission); });
        collect($roles)->each(function ($role){ Role::create($role); });
    }
}

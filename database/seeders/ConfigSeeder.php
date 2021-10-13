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
                'password'  => bcrypt('password'),
                'role_id'   =>  1,
            ],
            [
                'name'      =>  'pedro',
                'last_name' =>  'Correa',
                'phone'     =>  23435673,
                'email'     =>  'pd@m.com',
                'password'  => bcrypt('password'),
                'role_id'   =>  1,
            ],
            [
                'name'      =>  'juan',
                'last_name' =>  'Correa',
                'phone'     =>  23456735,
                'email'     =>  'jd@m.com',
                'password'  => bcrypt('password'),
                'role_id'   =>  1,
            ],
            [
                'name'      =>  'luci',
                'last_name' =>  'Correa',
                'phone'     =>  2345673,
                'email'     =>  'dx@m.com',
                'password'  => bcrypt('password'),
                'role_id'   =>  1,
            ],
        ];

        $roles = [
            [
                'name' => 'admin',
            ],
            [
                'name' => 'user',
            ],
            [
                'name' => 'pintor',
            ],
            [
                'name' => 'gerente',
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

        collect($roles)->each(function ($role){ Role::create($role); });
        collect($users)->each(function ($user){ User::create($user); });
        collect($permissions)->each(function ($permission){ Permission::create($permission); });
    }
}

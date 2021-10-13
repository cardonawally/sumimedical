<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function view_users(): \Inertia\Response
    {   $users = User::with('Roles.permissions')->get();
        $rol = Role::all();
        return Inertia::render('Applications/Users',[
            'users' => $users,
            'rol'   => $rol
        ]);

    }

    public function save_users(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            User::find($request->id)
                ->update($request->all()
                );


              $user = User::with('Roles.permissions')->get();
            return response()->json($user,'200');
        }catch (Exception $ex){
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function reques_role_one_and_two(){
       /**
        * select u.name, u.last_name, r.name as rol from roles r
       inner join users u on r.roles_id = u.id
       where r.id in (1,2)
        */
            $role= User::join('roles','roles.id','=','users.role_id')
            ->groupBy( 'nombre')->where('roles.id', '=','1'||'2')
            ->get(array(
                DB::raw('count(*) as cantidad'),
                DB::raw('role.name as nombre')
            ));

        /**
         * select p.name from permissions_to_roles ptr
        inner join permissions p on ptr.permission_id = p.id
        where role_id = 1
         */

        $role_two = User::join('permissions_to_roles','permission_id','=','permissions.id')
            ->groupBy( 'nombre')->where('roles_id', '=','1')
            ->get(array(
                DB::raw('count(*) as cantidad'),
                DB::raw('permissions.name as nombre')
            ));

        /**
         * .select r.name as rol, ptr.permission_id as permiso, u.name as usuario from permissions_to_roles ptr
        inner join roles r ON ptr.role_id = r.id
        inner join users u on r.id = u.role_id
        where ptr.permission_id = 2
         */

        $role_tree = User::join('permissions_to_roles','role_id','=','role.id')
            ->groupBy( 'nombre')->where('roles_id', '=','1')
            ->get(array(
                DB::raw('count(*) as cantidad'),
                DB::raw('permissions.name as nombre')
            ));

        return response([
            'role' => $role,
            'role_two' => $role_two,
            'role_tree' => $role_tree
        ], 200);


    }
}

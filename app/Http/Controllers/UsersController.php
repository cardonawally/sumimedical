<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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
}

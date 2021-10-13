<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RolesController extends Controller
{
    public function view_roles(): \Inertia\Response
    {
        $roles = Role::all();
        return Inertia::render('Applications/Roles',[
            'roles' => $roles
        ]);

    }

    public function save_roles(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            Role::create($request->all());

            $role = Role::all();
            return response()->json($role,'200');
        }catch (Exception $ex){
            return response()->json($ex->getMessage(), 500);
        }
    }
}

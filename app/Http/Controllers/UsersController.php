<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $users = User::with('Roles.permissions')->get();
        $rol = Role::all();

        return Inertia::render('Applications/Users',[
            'users' => $users,
            'rol'   => $rol
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
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

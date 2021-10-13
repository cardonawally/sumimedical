<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PermissionsController extends Controller
{
    public function view_permissions(): \Inertia\Response
    {

        $permisos = Permission::all();

        return Inertia::render('Applications/Permissions',[
            'permisos' => $permisos
        ]);

    }

    public function save_permissions(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            Permission::create($request->all());
            $permisos = Permission::all();
            return response()->json($permisos,'200');
        }catch (Exception $ex){
            return response()->json($ex->getMessage(), 500);
        }
    }
}
